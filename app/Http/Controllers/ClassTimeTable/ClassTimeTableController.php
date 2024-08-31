<?php

namespace App\Http\Controllers\ClassTimeTable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassName;
use App\Models\SubjectModel;
use App\Models\TimeTable;
use App\Models\ClassSubjectModel;
use App\Models\WeekModal;
use App\Models\TeacherModal;
use File;
use Hash;
use Auth;

class ClassTimeTableController extends Controller

{
    public function class_time_table_list(Request $request)
    {
        // Filter classes based on their status (only active classes with status 0)
        $classNames = ClassName::where('status', 0)
                               ->pluck('class_name', 'id');
    
        // Retrieve weeks for the form
        $weeks = WeekModal::pluck('week_name', 'id');
        
        // Filter teachers based on their status (only active teachers with status 0)
        $teachers = TeacherModal::where('status', 0)
                                ->pluck('name', 'id');
    
        // Retrieve time tables with related models
        $timeTables = TimeTable::with(['week', 'className', 'subject', 'teacher'])
                               ->orderBy('created_at', 'desc')
                               ->get();
    
        // Pass data to the view
        $data = [
            'header_title' => 'Class Time Table List',
            'classNames' => $classNames,
            'weeks' => $weeks,
            'timeTables' => $timeTables,
            'teachers' => $teachers,
        ];
    
        return view('admin.class_time_table_list', $data);
    }
    

    public function get_subject(Request $request)
    {
        try {
            $class_id = $request->class_id;

            $classSubjects = ClassSubjectModel::where('class_id', $class_id)
                                              ->with('subject')
                                              ->get();

            $html = "<option value=''>Select Subject</option>";
            if ($classSubjects->isEmpty()) {
                $html .= "<option value=''>No subjects found</option>";
            } else {
                foreach ($classSubjects as $classSubject) {
                    $html .= "<option value='" . $classSubject->subject_id . "'>" . $classSubject->subject->subject_name . "</option>";
                }
            }

            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching subjects.']);
        }
    }

    public function get_timetable(Request $request)
    {
        $class_id = $request->input('class_id');
        $subject_id = $request->input('subject_id');

        $timetableData = TimeTable::where('class_id', $class_id)
                                ->where('subject_id', $subject_id)
                                ->with('week')
                                ->get();

        if ($timetableData->isNotEmpty()) {
            $html = view('admin.timetable.rows', compact('timetableData'))->render();
            return response()->json([
                'html' => $html,
                'start_time' => $timetableData->first()->start_time,
                'end_time' => $timetableData->first()->end_time,
            ]);
        } else {
            return response()->json(['html' => null]);
        }
    }

    public function save_timetable(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'class_name' => 'required|exists:class_names,id',
            'subject_name' => 'required|exists:subject_models,id',
            'week_id' => 'required|exists:week_modals,id',
            'teacher_id' => 'required|exists:teacher_modals,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'room_number' => 'required|string|max:255',
        ]);

        // Check if the timetable entry already exists
        $existingTimetable = TimeTable::where('class_id', $validatedData['class_name'])
            ->where('subject_id', $validatedData['subject_name'])
            ->where('week_id', $validatedData['week_id'])
            ->where('teacher_id', $validatedData['teacher_id'])
            ->where('room_number', $validatedData['room_number'])
            ->where('start_time', $validatedData['start_time'])
            ->where('end_time', $validatedData['end_time'])
            ->first();

        if ($existingTimetable) {
            return redirect()->back()->with('error', 'This class is already assigned to the subject for the selected week with the same teacher, room number, start time, and end time.');
        }

        // Create a new TimeTable instance and fill it with validated data
        $timetable = new TimeTable();
        $timetable->class_id = $validatedData['class_name'];
        $timetable->subject_id = $validatedData['subject_name'];
        $timetable->week_id = $validatedData['week_id'];
        $timetable->teacher_id = $validatedData['teacher_id'];
        $timetable->start_time = $validatedData['start_time'];
        $timetable->end_time = $validatedData['end_time'];
        $timetable->room_number = $validatedData['room_number'];

        // Save the timetable to the database
        $timetable->save();

        // Optionally, fetch all timetables again to display on the view
        $timeTables = TimeTable::with('week', 'className', 'subject', 'teacher')
            ->orderBy('created_at', 'desc')
            ->get();

        // Optionally, you can return a success message or redirect
        return redirect()->back()->with('success', 'Timetable saved successfully!');
    }

   
    // delete

    public function deleteTimetable($id)
    {
        $timetable = TimeTable::findOrFail($id);
        $timetable->delete();

        return redirect()->back()->with('success', 'Timetable deleted successfully.');
    }




    // Student Side

    public function myTimetable()
    {
        // Retrieve the authenticated student
        $student = Auth::user()->student;

        // Check if the student exists
        if ($student) {
            // Load the associated class timetables
            $timetables = TimeTable::where('class_id', $student->class_id)
                ->with(['subject', 'week'])
                ->get();

            // Pass the timetables variable to the view
            return view('student.my_timetable', compact('student', 'timetables'));
        } else {
            // If the student does not exist, return a view indicating the error
            return view('student.dashboard');
        }
    }
}





