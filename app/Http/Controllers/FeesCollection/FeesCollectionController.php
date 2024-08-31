<?php

namespace App\Http\Controllers\FeesCollection;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Auth;
use App\Models\StudentFees;
use App\Models\ClassName;
use App\Models\StudentModal;
use App\Models\ParentModal;

class FeesCollectionController extends Controller
{
    public function feesCollection()
    {
        // Retrieve students with their related class and fees collection information
        $students = StudentModal::with(['class', 'feesCollection'])->get();

        return view('admin.fees_collection', compact('students'));
    }

    public function collectFeesAdd($studentId, $classId)
    {
        // Find the student and class
        $student = StudentModal::findOrFail($studentId);
        $class = ClassName::findOrFail($classId);

        // Calculate paid amount and remaining amount
        $paidAmount = $student->feesCollection()->where('class_id', $classId)->sum('paid_amount');
        $remainingAmount = $class->amount - $paidAmount;

        // Count the number of fee collection records
        $feesCollectionCount = $student->feesCollection()->where('class_id', $classId)->count();

        return view('admin.fees_collection_add', compact('student', 'class', 'feesCollectionCount', 'paidAmount', 'remainingAmount'));
    }

    public function storeCollectFees(Request $request)
    {
        // Validate the request data
        $request->validate([
            'student_id' => 'required|exists:student_modals,id',
            'class_id' => 'required|exists:class_names,id',
            'amount' => 'required|numeric|min:1',
            'payment_type' => 'required|string|max:255',
        ]);

        // Retrieve student and class details
        $student = StudentModal::findOrFail($request->input('student_id'));
        $class = ClassName::findOrFail($request->input('class_id'));

        // Calculate current paid amount and remaining amount
        $paidAmount = $student->feesCollection()->where('class_id', $class->id)->sum('paid_amount');
        $totalAmount = $class->amount;
        $currentAmount = $request->input('amount');
        $remainingAmount = $totalAmount - ($paidAmount + $currentAmount);

        // Check if the current paid amount exceeds the total amount
        if ($paidAmount + $currentAmount > $totalAmount) {
            return redirect()->back()
                ->withErrors(['amount' => 'The total paid amount cannot exceed the total amount of $' . number_format($totalAmount, 2)])
                ->withInput();
        }

        // Create a new instance of StudentFees model and populate its fields
        $feesCollection = new StudentFees();
        $feesCollection->student_id = $request->input('student_id');
        $feesCollection->class_id = $request->input('class_id');
        $feesCollection->total_amount = $totalAmount;
        $feesCollection->paid_amount = $paidAmount + $currentAmount;
        $feesCollection->remaining_amount = $remainingAmount;
        $feesCollection->payment_type = $request->input('payment_type');
        $feesCollection->created_by = auth()->id();
        $feesCollection->save();

        // Redirect back to the fees collection page with a success message
        return redirect()->route('admin.fees_collection')->with('success', 'Fees collected successfully.');
    }




    // student Side to show My Fees
    public function myFees()
    {
        $student = Auth::user()->student; // Assuming the logged-in user is a student

        // Debug: Check if we have a student
        if (!$student) {
            abort(403, 'No authenticated student found.');
        }

        // Debug: Check student ID
        // dd($student->id);

        $feesCollection = StudentFees::where('student_id', $student->id)->get();

        // Debug: Check if feesCollection has data
        // dd($feesCollection);

        return view('student.my_fees', compact('feesCollection'));
    }




    //parent side show My Student Fees
    public function showMyStudentFees()
    {
        // Get the authenticated parent
        $parent = auth()->user()->parent;
    
        // Fetch the students related to the parent
        $students = $parent->students;
    
        // Check if there are students associated with the parent
        if ($students->isEmpty()) {
            return response()->json(['error' => 'No students found for this parent.']);
        }
    
        // Initialize an array to store fees data for each student
        $studentsFeesData = [];
    
        // Iterate through each student to get their fees data
        foreach ($students as $student) {
            $feesData = StudentFees::where('student_id', $student->id)->get();
            $studentsFeesData[$student->id] = [
                'student' => $student,
                'feesData' => $feesData,
            ];
        }
    
        // Pass the data to the view
        return view('parent.my_student_fees', compact('studentsFeesData'));
    }

}



