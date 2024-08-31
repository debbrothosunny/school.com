<?php

namespace App\Http\Controllers\ClassSubject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use App\Models\ClassName;
use App\Models\SubjectModel;
use File;
use Auth;

class ClassSubjectController extends Controller
{
    public function assign_subject(Request $request)
    {
        // Start the query builder
        $query = ClassSubjectModel::with(['class', 'subject', 'creator'])
            ->orderBy('created_at', 'desc'); // Default ordering
    
        // Filter by class name if provided
        if ($request->filled('class_name')) {
            $query->whereHas('class', function ($classQuery) use ($request) {
                $classQuery->where('class_name', 'like', '%' . $request->class_name . '%');
            });
        }
    
        // Filter by subject name if provided
        if ($request->filled('subject_name')) {
            $query->whereHas('subject', function ($subjectQuery) use ($request) {
                $subjectQuery->where('subject_name', 'like', '%' . $request->subject_name . '%');
            });
        }
    
        // Filter by date if provided
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
    
        // Paginate the results
        $classSubjects = $query->paginate(15);
    
        // Prepare data for the view
        $data = [
            'header_title' => 'Assign Subject List',
            'classSubjects' => $classSubjects,
        ];
    
        return view('admin.assign_subject_list', $data);
    }
    

    public function assign_subject_list_add()
    {
        $data['classes'] = ClassName::with('classSubjects')->where('status', 0)->orderBy('class_name', 'asc')->get();
        $data['subjects'] = SubjectModel::with('classSubjects')->where('status', 0)->orderBy('subject_name', 'asc')->get();
        $data['header_title'] = "Assign Subject Add"; 
        return view('admin.assign_subject_list_add', $data);
    } 

    public function insert(Request $request)
    {
        // Validate the request
        $request->validate([
            'class_id' => 'required|exists:class_names,id',  
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subject_models,id',
            'status' => 'nullable|integer'
        ]);
    
        // Begin the process of assigning subjects to the class
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                // Check if the class subject relationship already exists
                $classSubject = ClassSubjectModel::firstOrNew([
                    'class_id' => $request->class_id,
                    'subject_id' => $subject_id,
                ]);
    
                // Update the class subject attributes
                $classSubject->status = $request->status ?? 0; // Default to 0 if status is not provided
                $classSubject->created_by = Auth::user()->id;
                $classSubject->save();
            }
    
            return redirect('admin/assign_subject_list')->with('success', "Subject(s) successfully assigned to class");
        } else {
            return redirect()->back()->with('error', 'Please select at least one subject');
        }
    }
    

    public function edit($id)
    {
        // Fetch the class subject record
        $classSubject = ClassSubjectModel::findOrFail($id);
    
        // Fetch all subjects
        $subjects = SubjectModel::where('status', 0)->orderBy('subject_name', 'asc')->get();
    
        // Fetch the assigned subject IDs for this class
        $getAssignSubjectID = ClassSubjectModel::where('class_id', $classSubject->class_id)
                                               ->pluck('subject_id')
                                               ->toArray();
    
        // Fetch all classes
        $classes = ClassName::where('status', 0)->orderBy('class_name', 'asc')->get();
    
        // Pass data to the view
        return view('admin.assign_subject_list_edit', compact('classSubject', 'subjects', 'getAssignSubjectID', 'classes'));
    }
    

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'class_id' => 'required|exists:class_names,id',
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subject_models,id',
            'status' => 'nullable|integer'
        ]);

        // Fetch the class subject record
        $classSubject = ClassSubjectModel::findOrFail($id);

        // Update the class subject record
        $classSubject->class_id = $request->class_id;
        $classSubject->status = $request->status ?? $classSubject->status;
        $classSubject->created_by = Auth::user()->id; // Assuming you have an 'updated_by' field
        $classSubject->save();

        // Update the subjects assigned to the class
        ClassSubjectModel::where('class_id', $classSubject->class_id)->delete();
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $newClassSubject = new ClassSubjectModel;
                $newClassSubject->class_id = $request->class_id;
                $newClassSubject->subject_id = $subject_id;
                $newClassSubject->status = $request->status;
                $newClassSubject->created_by = Auth::user()->id;
                $newClassSubject->save();
            }
        }

        return redirect('admin/assign_subject_list')->with('success', "Subject(s) successfully updated for the class");
    }


    public function delete($id)
    {
        // Find the exam schedule by its ID
        $classSubject = ClassSubjectModel::findOrFail($id);

        // Delete the exam schedule
        $classSubject->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data deleted successfully.');
    }
    
}   

