<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\ClassName;
use App\Models\StudentModal;
use App\Models\ExamSchedule;
use App\Models\SubjectModel;
use App\Models\AssignClassTeacher;
use App\Models\MarkGrade;
use App\Models\Result;
use App\Models\Setting;
use Auth;
use Log;
use DB;
use Cache;

class ExaminationController extends Controller
{
    public function exam_list(Request $request)
    {
        // Start building the query
        $query = Exam::with('creator')->orderBy('created_at', 'desc');

        // Apply filters based on the request
        if (!empty($request->get('exam_name'))) {
            $query->where('exam_name', 'like', '%' . $request->get('exam_name') . '%');
        }

        if (!empty($request->get('note'))) {
            $query->where('note', 'like', '%' . $request->get('note') . '%');
        }

        // Paginate the results with 2 records per page
        $exams = $query->paginate(20);

        // Data to be passed to the view
        $data['header_title'] = 'Exam List';

        // Return the view with the data and exams
        return view('admin.exam_list', $data, compact('data', 'exams'));
    }

    public function exam_list_add()
    {
        $exams = Exam::all();
        $data['header_title'] = 'Add New Exam';
        return view('admin.exam_list_add', compact('data', 'exams'));
    }

    public function exam_list_insert(Request $request)
    {
        // Validate the request data
        $request->validate([
            'exam_name' => 'required',
            'note' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]); {
            // Create a new SubjectModel instance
            $data = new Exam();

            // Assign validated data to the model instance
            $data->exam_name = $request->exam_name;
            $data->note = $request->note;
            $data->status = $request->status;
            $data->created_by = Auth::user()->id;

            $data->save();

            return redirect('admin/exam_list')->with('success', "Exam successfully Created");
        }
    }


    public function edit($id)
    {
        $exams = Exam::find($id);

        return view('admin.exam_list_edit', compact('exams'));
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::find($id);
        if ($exam) {
            // Validate the request data
            $request->validate([
                'exam_name' => 'nullable|string|max:255',
                'note' => 'nullable|string|max:255',
                'status' => 'nullable|integer',
            ]);

            // Update the exam
            $exam->exam_name = $request->exam_name;
            $exam->note = $request->note;
            $exam->status = $request->status;
            $exam->save();

            return redirect()->route('admin.exam_list')->with('success', 'Exam updated successfully.');
        } else {
            return redirect()->route('admin.exam_list')->with('error', 'Exam not found.');
        }
    }

    public function delete($id)
    {
        $exam = Exam::find($id);
        if ($exam) {
            // Delete the exam record
            $exam->delete();

            return redirect()->route('admin.exam_list')->with('success', 'Exam deleted successfully.');
        } else {
            return redirect()->route('admin.exam_list')->with('error', 'Exam not found.');
        }
    }

    // Exam Schedule  
    public function index()
    {
        // Fetch active exams, class names, and schedules with related models
        $exams = Exam::where('status', 0)->get(); // Only active exams (status = 0)
        $classNames = ClassName::where('status', 0)->get(); // Only active class names (status = 0)
        $schedules = ExamSchedule::with(['exam' => function ($query) {
                $query->where('status', 0); // Ensure only active exams are loaded
            }, 'className' => function ($query) {
                $query->where('status', 0); // Ensure only active class names are loaded
            }, 'subject' => function ($query) {
                $query->where('status', 0); // Ensure only active subjects are loaded
            }])
            ->get();
    
        return view('admin.exam_schedule', compact('exams', 'classNames', 'schedules'));
    }

    public function fetchSubjects(Request $request)
    {
        $classId = $request->class_id;

        // Fetch subjects related to the selected class ID with status = 0 using the relationship
        $subjects = SubjectModel::whereHas('classes', function ($query) use ($classId) {
                $query->where('class_id', $classId);
            })
            ->where('status', 0) // Only fetch active subjects (status = 0)
            ->pluck('subject_name', 'id');

        return response()->json($subjects);
    }

    public function saveExamSchedule(Request $request)
    {
        // Validate the request data
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required',
            'exam_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'room_number' => 'required|string|max:255',
            'full_mark' => 'required|integer',
            'passing_mark' => 'required|integer',
        ]);
    
        // Check if the schedule already exists
        $existingSchedule = ExamSchedule::where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->where('exam_id', $request->exam_id)
            ->first();
    
        if ($existingSchedule) {
            return redirect()->back()->withErrors(['msg' => 'This exam schedule already exists.']);
        }
    
        // Create new exam schedule
        $examSchedule = new ExamSchedule();
        $examSchedule->class_id = $request->class_id;
        $examSchedule->subject_id = $request->subject_id;
        $examSchedule->exam_id = $request->exam_id;
        $examSchedule->exam_date = $request->exam_date;
        $examSchedule->start_time = $request->start_time;
        $examSchedule->end_time = $request->end_time;
        $examSchedule->room_number = $request->room_number;
        $examSchedule->full_mark = $request->full_mark;
        $examSchedule->passing_mark = $request->passing_mark;
        $examSchedule->save();
    
        return redirect()->back()->with('success', 'Exam schedule created successfully.');
    }



    public function deleteExamSchedule($id)
    {
        // Find the exam schedule by its ID
        $examSchedule = ExamSchedule::findOrFail($id);

        // Delete the exam schedule
        $examSchedule->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Exam schedule deleted successfully.');
    }



    // mark Register

    public function markRegister(Request $request)
    {
        // Fetch only active exams and class names
        $getExam = Exam::where('status', 0)->get(); // Only active exams
        $getClass = ClassName::where('status', 0)->get(); // Only active class names
    
        $students = [];
        $subjects = [];
        $marksData = [];
    
        // Check if exam_id and class_id are provided
        if ($request->has('exam_id') && $request->has('class_id')) {
            $exam_id = $request->input('exam_id');
            $class_id = $request->input('class_id');
    
            // Fetch only active students in the selected class
            $students = StudentModal::where('class_id', $class_id)
                                    ->where('status', 0) // Only active students
                                    ->get();
    
            // Fetch only active subjects with exam schedules for the selected exam and class
            $subjects = SubjectModel::where('status', 0) // Only active subjects
                ->whereHas('examSchedules', function ($query) use ($exam_id, $class_id) {
                    $query->where('exam_id', $exam_id)
                        ->where('class_id', $class_id)
                        ->where('status', 0); // Only active exam schedules
                })
                ->with(['examSchedules' => function($query) use ($exam_id, $class_id) {
                    $query->where('exam_id', $exam_id)
                        ->where('class_id', $class_id); // Only active exam schedules
                }])
                ->get();
    
            // Fetch marks for the selected exam and class
            $marks = Mark::where('exam_id', $exam_id)
                         ->where('class_id', $class_id)
                         ->get();
    
            // Organize marks data by student and subject
            foreach ($marks as $mark) {
                $marksData[$mark->student_id][$mark->subject_id] = $mark;
            }
        }
    
        return view('admin.mark_register', compact('getExam', 'getClass', 'students', 'subjects', 'marksData'));
    }

    public function fetchSubjectsAndStudents(Request $request)
    {
        $classId = $request->input('class_id');
        $examId = $request->input('exam_id');

        $students = StudentModal::where('class_id', $classId)->get();
        $subjects = SubjectModel::whereHas('examSchedules', function ($query) use ($examId, $classId) {
            $query->where('exam_id', $examId)
                  ->where('class_id', $classId);
        })->get();

        return response()->json([
            'students' => $students,
            'subjects' => $subjects
        ]);
    }

    public function saveMarks(Request $request)
    {
        // Validate the request
        $request->validate([
            'student_id' => 'required|integer',
            'exam_id' => 'required|integer',
            'class_id' => 'required|integer',
            'marks' => 'required|array',
        ]);

        // Process saving marks for each subject
        foreach ($request->marks as $subjectId => $marks) {
            // Check if marks entry exists, if not create new one
            $mark = Mark::updateOrCreate(
                [
                    'student_id' => $request->student_id,
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'subject_id' => $subjectId,
                ],
                [
                    'class_work' => $marks['class_work'],
                    'home_work' => $marks['home_work'],
                    'exam_work' => $marks['exam_work'],
                    'test_work' => $marks['test_work'],
                ]
            );
        }

        return response()->json(['message' => 'Marks saved successfully!']);
    }

    public function saveSingleSubjectMarks(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'student_id' => 'required|integer',
            'exam_id' => 'required|integer',
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'marks.class_work' => 'required|numeric',
            'marks.home_work' => 'required|numeric',
            'marks.exam_work' => 'required|numeric',
            'marks.test_work' => 'required|numeric',
        ]);
    
        try {
            // Calculate total marks
            $totalMarks = $request->input('marks.class_work') + $request->input('marks.home_work') + $request->input('marks.exam_work') + $request->input('marks.test_work');
    
            // Get the passing mark for the subject
            $subject = SubjectModel::with(['examSchedules' => function($query) use ($request) {
                $query->where('exam_id', $request->exam_id)
                      ->where('class_id', $request->class_id);
            }])->find($request->subject_id);
    
            $passingMark = $subject->examSchedules->first()->passing_mark ?? 0;
    
            // Determine if the student passed or failed
            $status = $totalMarks >= $passingMark ? 'Pass' : 'Fail';
    
            // Save or update marks for the student and subject
            $mark = Mark::updateOrCreate(
                [
                    'student_id' => $request->student_id,
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'subject_id' => $request->subject_id,
                ],
                [
                    'class_work' => $request->input('marks.class_work'),
                    'home_work' => $request->input('marks.home_work'),
                    'exam_work' => $request->input('marks.exam_work'),
                    'test_work' => $request->input('marks.test_work'),
                    'total_marks' => $totalMarks,
                    'status' => $status,
                ]
            );
    
            // Return success response with pass/fail status
            return response()->json(['message' => 'Marks saved successfully!', 'status' => $status]);
    
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return response()->json(['error' => 'Failed to save marks. Please try again.'], 500);
        }
    }



//    saved Marks Right Now close If needed its turn on

    // public function savedMarks(Request $request)
    // {
    //     $query = Mark::query();
    
    //     if ($request->has('student_name') && $request->student_name != '') {
    //         $query->whereHas('student', function ($q) use ($request) {
    //             $q->where('first_name', 'like', '%' . $request->student_name . '%')
    //               ->orWhere('last_name', 'like', '%' . $request->student_name . '%');
    //         });
    //     }
    
    //     if ($request->has('exam_name') && $request->exam_name != '') {
    //         $query->whereHas('exam', function ($q) use ($request) {
    //             $q->where('exam_name', 'like', '%' . $request->exam_name . '%');
    //         });
    //     }
    
    //     if ($request->has('class_name') && $request->class_name != '') {
    //         $query->whereHas('className', function ($q) use ($request) {
    //             $q->where('class_name', 'like', '%' . $request->class_name . '%');
    //         });
    //     }
    
    //     if ($request->has('subject_name') && $request->subject_name != '') {
    //         $query->whereHas('subject', function ($q) use ($request) {
    //             $q->where('subject_name', 'like', '%' . $request->subject_name . '%');
    //         });
    //     }
    
    //     $savedMarks = $query->orderBy('created_at', 'desc')->paginate(10); // Adjust pagination as per your requirement
    
    //     return view('admin.saved_marks', compact('savedMarks'));
    // }




    // Exam Result

    public function result(Request $request)
    {
        // Cache exams, classes, and mark grades
        $getExam = Cache::remember('active_exams', 60, function() {
            return Exam::where('status', 0)->get();
        });
    
        $getClass = Cache::remember('active_classes', 60, function() {
            return ClassName::where('status', 0)->get();
        });
    
        $markGrades = Cache::remember('mark_grades', 60, function() {
            return MarkGrade::get();
        });
    
        $students = [];
        $subjects = [];
        $marksData = [];
    
        if ($request->has('exam_id') && $request->has('class_id')) {
            $exam_id = $request->input('exam_id');
            $class_id = $request->input('class_id');
    
            // Eager load students with related marks and subjects in a single query
            $students = StudentModal::where('class_id', $class_id)
                                    ->where('status', 0)
                                    ->with(['marks' => function($query) use ($exam_id) {
                                        $query->where('exam_id', $exam_id);
                                    }])
                                    ->get();
    
            // Retrieve subjects with related exam schedules and marks in one go
            $subjects = SubjectModel::whereHas('examSchedules', function ($query) use ($exam_id, $class_id) {
                    $query->where('exam_id', $exam_id)
                          ->where('class_id', $class_id);
                })
                ->where('status', 0)
                ->with(['examSchedules' => function($query) use ($exam_id, $class_id) {
                    $query->where('exam_id', $exam_id)
                          ->where('class_id', $class_id);
                }])
                ->get();
    
            // Collect marks data in one go and map them to students and subjects
            $marks = Mark::where('exam_id', $exam_id)
                         ->where('class_id', $class_id)
                         ->get();
    
            // Organize marks data by student and subject
            foreach ($marks as $mark) {
                $marksData[$mark->student_id][$mark->subject_id] = $mark;
            }
        }
    
        // Return view with filtered data
        return view('admin.result', compact('getClass', 'getExam', 'students', 'subjects', 'marksData', 'markGrades'));
    }
    
    


    // Student Side to Show My Result

    public function myResult()
    {
        // Retrieve the logged-in student's details
        $student = Auth::user()->student; // Assuming you have a relationship set up in the User model
    
        // Get the student's class ID dynamically
        $classId = $student->class_id;
    
        // Get the latest exam ID for the class dynamically
        $exam = Exam::whereHas('examSchedules', function ($query) use ($classId) {
            $query->where('class_id', $classId);
        })->latest()->first();
    
        if (!$exam) {
            return view('student.my_result')->withErrors(['No exam found for the class']);
        }
    
        // Get subjects for the selected class and exam
        $subjects = SubjectModel::whereHas('examSchedules', function ($query) use ($classId, $exam) {
            $query->where('class_id', $classId)
                  ->where('exam_id', $exam->id);
        })->get();
    
        // Get marks data for the selected class, exam, and student
        $marksData = Mark::where('student_id', $student->id)
                        ->whereIn('subject_id', $subjects->pluck('id'))
                        ->get()
                        ->groupBy('subject_id');
    
        return view('student.my_result', compact('student', 'subjects', 'marksData', 'exam'));
    }

       // Student Side to Show myExamSchedule
        public function myExamSchedule()
        {
            // Assuming you have a relationship between the student and their class
            $student = Auth::user()->student;// Or however you get the logged-in student
            $classId = $student->class_id; 

            // Fetch exam schedules for the student's class
            $schedules = ExamSchedule::where('class_id', $classId)
                                    ->with(['exam', 'className', 'subject'])
                                    ->get();

            return view('student.my_exam_schedule', compact('schedules'));
        }



        // Teacher Side to show 
        public function teacherExamSchedule()
        {
            // Retrieve the authenticated teacher
            $teacher = Auth::user()->teacher;
    
            // Debug: Check if the teacher is correctly retrieved
            if (!$teacher) {
                return redirect()->back()->with('error', 'Teacher not found.');
            }
    
            // Get the classes and subjects assigned to the teacher
            $assignedClassesSubjects = AssignClassTeacher::where('teacher_id', $teacher->id)->get();
    
            // Debug: Check if assigned classes and subjects are retrieved correctly
            if ($assignedClassesSubjects->isEmpty()) {
                return redirect()->back()->with('error', 'No classes or subjects assigned to this teacher.');
            }
    
            // Get the exam schedules for the assigned classes and subjects
            $schedules = ExamSchedule::whereIn('class_id', $assignedClassesSubjects->pluck('class_id'))
                                     ->whereIn('subject_id', $assignedClassesSubjects->pluck('subject_id'))
                                     ->with(['className', 'subject', 'exam'])
                                     ->orderBy('exam_date', 'asc')
                                     ->get();
    
            // Debug: Check if exam schedules are retrieved correctly
            if ($schedules->isEmpty()) {
                $debug = [
                    'class_ids' => $assignedClassesSubjects->pluck('class_id'),
                    'subject_ids' => $assignedClassesSubjects->pluck('subject_id')
                ];
                return view('teacher.my_exam_schedule', compact('schedules'))->with('debug', json_encode($debug));
            }
    
            return view('teacher.my_exam_schedule', compact('schedules'));
        }






    // Mark Grade Function

    public function markGrade()
    {
        $markGrades = MarkGrade::all();
        return view('admin.mark_grade', compact('markGrades'));
    }

    public function markGradeCreate()
    {
        return view('admin.mark_grade_add');
    }

    public function markGradeStore(Request $request)
    {
        // Validate the request data
        $request->validate([
            'grade_name' => 'required|string|max:255',
            'percent_from' => 'required',
            'percent_to' => 'required',
        ]); {
            // Create a new SubjectModel instance
            $data = new MarkGrade();

            // Assign validated data to the model instance
            $data->grade_name = $request->grade_name;
            $data->percent_from = $request->percent_from;
            $data->percent_to = $request->percent_to;
            $data->created_by = Auth::user()->id;

            $data->save();

            return redirect()->route('admin.mark_grade')->with('success', "Data successfully Created");
        }
    }

    public function markGradeEdit($id)
    {
        $markGrade = MarkGrade::findOrFail($id);
        return view('admin.mark_grade_edit', compact('markGrade'));
    }

    public function markGradeUpdate(Request $request, $id)
    {
          $data = MarkGrade::find($id);
        if ($data) {
            // Validate the request data
            $request->validate([
                'grade_name' => 'nullable|string|max:255',
                'percent_from' => 'nullable',
                'percent_to' => 'nullable',
            ]);

            // Update the Mark Grade
            $data->grade_name = $request->grade_name;
            $data->percent_from = $request->percent_from;
            $data->percent_to = $request->percent_to;
            $data->created_by = Auth::user()->id;
            $data->save();

            return redirect()->route('admin.mark_grade')->with('success', 'Data updated successfully.');
        } else {
            return redirect()->route('admin.mark_grade')->with('error', 'Data not found.');
        }

        return redirect()->route('admin.mark_grade')->with('success', 'Mark Grade updated successfully.');
    }

    public function markGradeDestroy($id)
    {
        $markGrade = MarkGrade::findOrFail($id);
        $markGrade->delete();
        return redirect()->route('admin.mark_grade')->with('success', 'Mark Grade deleted successfully.');
    }



    // print exam result for student side 

    public function printResults($examId, $studentId)
    {
        // Fetch student details
        $student = StudentModal::findOrFail($studentId);

        $schoolName = Setting::value('school_name');
        
        // Fetch exam details
        $exam = Exam::findOrFail($examId);
        $examName = $exam->exam_name;
    
        // Fetch subjects related to the exam
        $subjects = SubjectModel::whereHas('examSchedules', function($query) use ($examId) {
            $query->where('exam_id', $examId);
        })->get();
        
        // Initialize marks data
        $marksData = $this->fetchMarksData($studentId, $examId); // Adjust method if needed
    
        // Initialize totals and flags
        $totalMarks = 0;
        $totalFullMarks = 0;
        $overallPass = true;
    
        // Calculate total marks and full marks
        foreach ($subjects as $subject) {
            $classWork = $marksData[$subject->id]['class_work'] ?? 0;
            $homeWork = $marksData[$subject->id]['home_work'] ?? 0;
            $examWork = $marksData[$subject->id]['exam_work'] ?? 0;
            $testWork = $marksData[$subject->id]['test_work'] ?? 0;
            
            $subjectTotalMarks = $classWork + $homeWork + $examWork + $testWork;
            $subjectFullMark = optional($subject->examSchedules->first())->full_mark ?? 0;
            $subjectPassingMark = optional($subject->examSchedules->first())->passing_mark ?? 0;
            
            $totalMarks += $subjectTotalMarks;
            $totalFullMarks += $subjectFullMark;
    
            // Check if the student has failed any subject
            if ($subjectTotalMarks < $subjectPassingMark) {
                $overallPass = false;
            }
        }
        
        // Calculate percentage and determine grade
        $percentage = ($totalMarks / $totalFullMarks) * 100;
        $grade = \App\Models\MarkGrade::getGrade($percentage);
        $gradeName = $overallPass ? ($grade ? $grade->grade_name : 'N/A') : 'Fail';
        
        // Pass data to the view
        return view('student.my_result_print', compact('student', 'subjects', 'marksData', 'examName', 'gradeName', 'overallPass','schoolName'));
    }


    public function fetchMarksData($studentId, $examId)
    {
    // Assuming you have a `StudentMarks` model or similar for storing marks
    return Mark::where('student_id', $studentId)
                        ->where('exam_id', $examId)
                        ->get()
                        ->groupBy('subject_id')
                        ->map(function ($marks) {
                            return [
                                'class_work' => $marks->sum('class_work'),
                                'home_work' => $marks->sum('home_work'),
                                'exam_work' => $marks->sum('exam_work'),
                                'test_work' => $marks->sum('test_work')
                            ];
                        });
    }


    // Parent side to show my stdent result

    public function myStudentResult()
    {
        $user = Auth::user();
        $parent = $user->parent;
    
        if (!$parent) {
            return view('parent.my_student_result')->withErrors(['No parent record found for the logged-in user.']);
        }
    
        $students = $parent->students;
    
        if ($students->isEmpty()) {
            return view('parent.my_student_result')->withErrors(['No students found for the logged-in parent.']);
        }
    
        $examId = null;
        $subjects = SubjectModel::whereHas('examSchedules', function ($query) use ($students) {
            $query->whereIn('class_id', $students->pluck('class_id')->unique());
        })->get();
    
        $studentsResults = [];
    
        foreach ($students as $student) {
            $classId = $student->class_id ?? null;
    
            if ($classId === null) {
                $studentsResults[$student->id] = [
                    'student' => $student,
                    'error' => 'Class ID not found for this student.'
                ];
                continue;
            }
    
            $exam = Exam::whereHas('examSchedules', function ($query) use ($classId) {
                $query->where('class_id', $classId);
            })->latest()->first();
    
            if ($exam) {
                $examId = $exam->id;
    
                $subjectsForStudent = $subjects->filter(function ($subject) use ($classId, $examId) {
                    return $subject->examSchedules->contains(function ($schedule) use ($classId, $examId) {
                        return $schedule->class_id == $classId && $schedule->exam_id == $examId;
                    });
                });
    
                $marksData = Mark::where('student_id', $student->id)
                    ->whereIn('subject_id', $subjectsForStudent->pluck('id'))
                    ->get()
                    ->groupBy('subject_id');
    
                $studentsResults[$student->id] = [
                    'student' => $student,
                    'exam' => $exam,
                    'subjects' => $subjectsForStudent,
                    'marksData' => $marksData
                ];
            } else {
                $studentsResults[$student->id] = [
                    'student' => $student,
                    'error' => 'No exam found for the class.'
                ];
            }
        }
    
        return view('parent.my_student_result', [
            'studentsResults' => $studentsResults,
            'subjects' => $subjects,
            'examId' => $examId
        ]);
    }
    
    


    // Parent Side to show my student result Print function

    public function printStudentResult($studentId, $examId)
    {
        $student = StudentModal::with('className')->findOrFail($studentId);
        $examName = Exam::findOrFail($examId)->exam_name;
        $schoolName = Setting::value('school_name');
        $subjects = SubjectModel::with(['examSchedules' => function ($query) use ($examId) {
            $query->where('exam_id', $examId);
        }])->whereHas('classes', function ($query) use ($student) {
            $query->where('class_id', $student->class_id);
        })->get();

        $marksData = [];

        foreach ($subjects as $subject) {
            $marks = $subject->marks()->where('student_id', $studentId)->where('exam_id', $examId)->first();
            $marksData[$subject->id] = [
                'class_work' => $marks->class_work ?? 0,
                'home_work' => $marks->home_work ?? 0,
                'exam_work' => $marks->exam_work ?? 0,
                'test_work' => $marks->test_work ?? 0,
            ];
        }

        return view('parent.print_student_result', compact('student', 'examName', 'subjects', 'marksData','schoolName'));
    }
    
    private function calculateOverallPass($marksData, $subjects)
    {
        // Implement logic to determine overall pass status
        // Example: return true if the student passed all subjects
        foreach ($subjects as $subject) {
            $subjectTotalMarks = (
                ($marksData[$subject->id]['class_work']->first()->marks ?? 0) +
                ($marksData[$subject->id]['home_work']->first()->marks ?? 0) +
                ($marksData[$subject->id]['exam_work']->first()->marks ?? 0) +
                ($marksData[$subject->id]['test_work']->first()->marks ?? 0)
            );
            $subjectPassingMark = optional($subject->examSchedules->first())->passing_mark ?? 0;
            if ($subjectTotalMarks < $subjectPassingMark) {
                return false;
            }
        }
        return true;
    }
    
    private function calculateGrade($marksData, $subjects)
    {
        // Implement logic to calculate the grade based on marksData
        // Example: return a grade name like "A", "B", "C", etc.
        // This is a placeholder implementation
        return 'A'; // Replace with actual grade calculation logic
    }


    
    


}

    








