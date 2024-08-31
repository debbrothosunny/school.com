<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use File;
use Hash;



class SubjectController extends Controller
{
    public function subject(Request $request)
{
    $query = SubjectModel::select('subject_models.*', 'users.name as created_by')
        ->join('users', 'users.id', '=', 'subject_models.created_by');

    if (!empty($request->get('date'))) {
        $query = $query->whereDate('subject_models.created_at', '=', $request->get('date'));
    }

    if (!empty($request->get('subject_name'))) {
        $query = $query->where('subject_models.subject_name', 'like', '%' . $request->get('subject_name') . '%');
    }

    $data['getRecord'] = $query->orderByDesc('subject_models.id')->paginate(50);
    $data['header_title'] = 'Subject List';

    return view('admin.subject_list', $data);
}

    public function subject_list_add()
    {
        $data['header_title'] = 'Add New Subject';
        return view('admin.subject_list_add', $data);
    }

    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'subject_name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $subject = new SubjectModel();
        $subject->subject_name = $request->subject_name;
        $subject->type = $request->type;
        $subject->status = $request->status;
        $subject->created_by = Auth::user()->id;
        $subject->save();

        return redirect()->route('admin.subject_list_add')->with('success', 'Subject Successfully Created');
    }

    public function edit($id)
    {
        $subject = SubjectModel::find($id);

     
            $data['subject'] = $subject;
            $data['header_title'] = 'Edit Subject';
            return view('admin.subject_list_edit', $data);
    }
    

    public function update(Request $request, $id)
    {
        $subject = SubjectModel::find($id);

            $validatedData = $request->validate([
                'subject_name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'status' => 'required|string|max:255',
            ]);

            $subject->subject_name = trim($request->subject_name);
            $subject->type = trim($request->type);
            $subject->status = $request->status;
            $subject->save();

            return redirect('admin/subject_list')->with('success', 'Subject successfully updated.');
    }

    public function delete($id)
    {
        $subject = SubjectModel::find($id);

        $subject->delete();

        return redirect()->back()->with('success', 'Data deleted successfully.');
    }

    // My Subject Student Side Show
    
    public function mySubject()
    {
        // Retrieve the authenticated student
        $student = Auth::user()->student; // Assuming the authenticated user is a student

        // Check if the student exists
        if ($student) {
            // Load the associated class subjects
            $classSubjects = ClassSubjectModel::where('class_id', $student->class_id)->get();

            // Extract subjects from classSubjects
            $subjects = $classSubjects->map(function ($classSubject) {
                return $classSubject->subject;
            });

            // Pass the student and subjects variables to the view
            return view('student.my_subject', compact('student', 'subjects'));
        } else {
            // If the student does not exist, return a view indicating the error
            return view('student.dashboard');
        }
    }

    
}
