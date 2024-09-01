<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Class\ClassController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\ClassSubject\ClassSubjectController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Parent\ParentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\AssignClassTeacher\AssignClassTeacherController;
use App\Http\Controllers\ClassTimeTable\ClassTimeTableController;
use App\Http\Controllers\Exam\ExaminationController;
use App\Http\Controllers\StudentAttendance\StudentAttendanceController;
use App\Http\Controllers\Communicate\CommunicateController;
use App\Http\Controllers\HomeWork\HomeWorkController;
use App\Http\Controllers\FeesCollection\FeesCollectionController;
use App\Http\Controllers\BusSchedule\BusScheduleController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Notification\NotificationController;


/*resu
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AdminController::class, 'Login'])->name('admin.login');
Route::post('login', [AdminController::class, 'AuthLogin'])->name('login');
Route::get('logout', [AdminController::class, 'logout'])->name('logout');
Route::get('forget-password', [AdminController::class, 'forgetpassword'])->name('forget_password'); 
Route::post('forget-password', [AdminController::class, 'PostForgetPassword'])->name('admin.postForgetPassword');
Route::get('password/reset/{token}', [AdminController::class, 'showResetForm'])->name('password.reset');


Route::group(['middleware' => 'admin'], function () {

Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/admin_list', [AdminController::class, 'admin_list'])->name('admin.admin_list');
Route::get('admin/admin_list/add', [AdminController::class, 'admin_list_add'])->name('admin.admin_list_add');
Route::post('admin/admin_list/add', [AdminController::class, 'insert'])->name('admin.create');
Route::get('admin/edit/{id}', [AdminController::class, 'edit']);
Route::post('admin/edit/{id}', [AdminController::class, 'update']);
Route::get('admin/delete/{id}', [AdminController::class, 'delete']);

// Teacher Route
Route::get('admin/teacher_list', [TeacherController::class, 'teacher_list'])->name('admin.teacher_list');
Route::get('admin/teacher_list/add', [TeacherController::class, 'teacher_list_add']);
Route::post('admin/teacher_list/add', [TeacherController::class, 'teacher_list_insert']);
Route::get('admin/teacher_list_edit/edit/{id}', [TeacherController::class, 'edit']);
Route::post('admin/teacher_list_edit/edit/{id}', [TeacherController::class, 'update']);
Route::get('admin/teacher_list/delete/{id}', [TeacherController::class, 'delete'])->name('admin.teacher_list.delete');
Route::get('/admin/teacher_list/search', [TeacherController::class, 'search'])->name('teacher.search');

// Student Route
Route::get('admin/student_list', [StudentController::class, 'student_list'])->name('admin.student_list');
Route::get('admin/student_list/add', [StudentController::class, 'student_list_add'])->name('admin.student_list_add');
Route::post('admin/student_list/add', [StudentController::class, 'student_list_insert']);
Route::get('admin/student_list_edit/edit/{id}', [StudentController::class, 'edit']);
Route::post('admin/student_list_edit/edit/{id}', [StudentController::class, 'update'])->name('admin.update_student');
Route::get('admin/student_list/delete/{id}', [StudentController::class, 'delete'])->name('admin.student_list.delete');


// Parent Route
Route::get('admin/parent_list', [ParentController::class, 'parent_list'])->name('admin.parent_list');
Route::get('admin/parent_list/add', [ParentController::class, 'parent_list_add'])->name('admin.parent_list_add');
Route::post('admin/parent_list/add', [ParentController::class, 'parent_list_insert']);
Route::get('admin/parent_list_edit/edit/{id}', [ParentController::class, 'edit']);
Route::post('admin/parent_list_edit/edit/{id}', [ParentController::class, 'update'])->name('admin.parent.update');  
Route::get('admin/parent_list/delete/{id}', [ParentController::class, 'delete'])->name('admin.parent_list.delete');
// Route::get('admin/my_student/{id}', [ParentController::class, 'myStudent']);
Route::get('/admin/parent_list/search', [ParentController::class, 'search'])->name('parent.search');

// Class Route
Route::get('admin/class_list', [ClassController::class, 'classList'])->name('admin.class_list');
Route::get('admin/class_list/add', [ClassController::class, 'classListAdd'])->name('admin.class_list_add');
Route::post('admin/class_list/add', [ClassController::class, 'insert'])->name('admin.class_list.insert');
Route::get('admin/class_list_edit/edit/{id}', [ClassController::class, 'edit'])->name('admin.class_list_edit');
Route::post('admin/class_list_edit/edit/{id}', [ClassController::class, 'update'])->name('admin.class_list_update');
Route::get('admin/class_list/delete/{id}', [ClassController::class, 'delete'])->name('admin.class_list.delete');



// Subject Route
Route::get('admin/subject_list', [SubjectController::class, 'subject'])->name('admin.subject_list');
Route::get('admin/subject_list/add', [SubjectController::class, 'subject_list_add'])->name('admin.subject_list_add');
Route::post('admin/subject_list/add', [SubjectController::class, 'insert']);
Route::get('admin/subject_list_edit/edit/{id}', [SubjectController::class, 'edit']);
Route::post('admin/subject_list_edit/edit/{id}', [SubjectController::class, 'update']);
Route::get('admin/subject_list/delete/{id}', [SubjectController::class, 'delete'])->name('admin.subject_list.delete');


// Assign Subject Route
Route::get('admin/assign_subject_list', [ClassSubjectController::class, 'assign_subject'])->name('admin.assign_subject_list');
Route::get('admin/assign_subject_list/add', [ClassSubjectController::class, 'assign_subject_list_add'])->name('admin.assign_subject_list_add');
Route::post('admin/assign_subject_list/add', [ClassSubjectController::class, 'insert']);
Route::get('admin/assign_subject_list_edit/edit/{id}', [ClassSubjectController::class, 'edit']);
Route::post('admin/assign_subject_list_edit/edit/{id}', [ClassSubjectController::class, 'update']);
Route::get('admin/assign_subject_list/delete/{id}', [ClassSubjectController::class, 'delete'])->name('admin.assign_subject_list.delete');


// Class Titme Table Route
Route::get('admin/class_time_table_list', [ClassTimeTableController::class, 'class_time_table_list'])->name('admin.class_time_table_list');
Route::get('/get-class-names', [ClassTimeTableController::class, 'getClassNames'])->name('get.class.names');
Route::get('admin/get-subjects-by-class', [ClassTimeTableController::class, 'getSubjectsByClass'])->name('admin.get.subjects.by.class');
Route::post('/get-subjects', [ClassTimeTableController::class, 'get_subject'])->name('admin.get.subject');
Route::post('/get-timetable', [ClassTimeTableController::class, 'getTimetable'])->name('admin.get_timetable');
Route::post('/save-timetable', [ClassTimeTableController::class, 'save_timetable'])->name('admin.save_timetable');
Route::get('/admin/timetable/{id}', [ClassTimeTableController::class, 'deleteTimetable'])->name('admin.delete_timetable');


// Exam List Route
Route::get('admin/exam_list', [ExaminationController::class, 'exam_list'])->name('admin.exam_list');
Route::get('admin/exam_list/add', [ExaminationController::class, 'exam_list_add'])->name('admin.exam_list_add');
Route::post('admin/exam_list/add', [ExaminationController::class, 'exam_list_insert']);
Route::get('admin/exam_list_edit/edit/{id}', [ExaminationController::class, 'edit']);
Route::post('admin/exam_list_edit/edit/{id}', [ExaminationController::class, 'update']);
Route::get('admin/exam_list/delete/{id}', [ExaminationController::class, 'delete'])->name('admin.exam_list.delete');


// Exam Schedule Route
Route::get('admin/exam_schedule', [ExaminationController::class, 'index'])->name('admin.exam_schedule');
Route::post('admin/get-exam-subjects', [ExaminationController::class, 'fetchSubjects'])->name('admin.fetch_subjects');
Route::post('admin/save-exam-schedule', [ExaminationController::class, 'saveExamSchedule'])->name('admin.save_exam_schedule');
Route::get('/exam-schedule/{id}', [ExaminationController::class, 'deleteExamSchedule'])->name('admin.delete_exam_schedule');


// Mark Register Route
Route::get('admin/mark_register', [ExaminationController::class, 'markRegister'])->name('admin.mark_register');
Route::get('admin/fetch-subjects-and-students', [ExaminationController::class, 'fetchSubjectsAndStudents'])->name('admin.fetchSubjectsAndStudents');
Route::post('admin/save-marks', [ExaminationController::class, 'saveMarks'])->name('admin.saveMarks');
Route::post('admin/saveSingleSubjectMarks', [ExaminationController::class, 'saveSingleSubjectMarks'])->name('admin.saveSingleSubjectMarks');
// Route::get('admin//saved_marks', [ExaminationController::class, 'savedMarks'])->name('admin.saved_marks');
Route::get('admin/result', [ExaminationController::class, 'Result'])->name('admin.result');


// Mark Grade Route
Route::get('admin/mark_grade', [ExaminationController::class, 'markGrade'])->name('admin.mark_grade');
Route::get('admin/mark_grade/add', [ExaminationController::class, 'markGradeCreate'])->name('admin.mark_grade_add');
Route::post('admin/mark_grade/add', [ExaminationController::class, 'markGradeStore']);
Route::get('admin/mark_grade/edit/{id}', [ExaminationController::class, 'markGradeEdit'])->name('admin.mark_grade_edit');
Route::post('admin/mark_grade/edit/{id}', [ExaminationController::class, 'markGradeUpdate']);
Route::get('admin/mark_grade/delete/{id}', [ExaminationController::class, 'markGradeDestroy'])->name('admin.mark_grade_delete');




// Student Attendence Route
Route::get('admin/student_attendance', [StudentAttendanceController::class, 'index'])->name('admin.student_attendance');
Route::get('admin/student_attendance/show', [StudentAttendanceController::class, 'showAttendance'])->name('attendance.show');
Route::post('admin/student_attendance/save', [StudentAttendanceController::class, 'save'])->name('attendance.save');
Route::get('/attendance/report', [StudentAttendanceController::class, 'attendanceReport'])->name('admin.attendance_report');


// Notice Board Route
Route::get('admin/communicate/notice_board_list', [CommunicateController::class, 'NoticeBoard'])->name('admin.notice_board_list');
Route::get('admin/communicate/notice_board_list_add', [CommunicateController::class, 'NoticeBoardAdd'])->name('admin.notice_board_list_add');
Route::post('admin/communicate/notice_board_store', [CommunicateController::class, 'NoticeBoardStore'])->name('admin.notice_board_store');
Route::get('admin/notice_board_list_edit/edit/{id}', [CommunicateController::class, 'NoticeBoardEdit'])->name('admin.notice_board.edit');
Route::post('admin/notice_board_list_edit/update/{id}', [CommunicateController::class, 'NoticeBoardUpdate'])->name('admin.notice_board.update');
Route::get('admin/notice_board_list/delete/{id}', [CommunicateController::class, 'NoticeBoardDelete'])->name('admin.notice_board.delete');


// Fees Collection Route
Route::get('admin/fees_collection', [FeesCollectionController::class, 'FeesCollection'])->name('admin.fees_collection');
Route::post('fees-collection/collect/{id}', [FeesCollectionController::class, 'collectFees'])->name('fees_collection.collect');
// Route for showing the form to collect fees
Route::get('admin/fees_collection_add/{student_id}/{class_id}', [FeesCollectionController::class, 'collectFeesAdd'])->name('admin.fees_collection_add');
// Route for storing the collected fees
Route::post('admin/fees-collection/store', [FeesCollectionController::class, 'storeCollectFees'])->name('admin.fees_collection.store');





// Assign Class Teacher Route
Route::get('admin/assign_class_teacher_list', [AssignClassTeacherController::class, 'list'])->name('admin.assign_class_teacher_list');
Route::get('admin/assign_class_teacher_list/add', [AssignClassTeacherController::class, 'assign_class_teacher_list_add'])->name('assign_class_teacher.add');
Route::post('admin/assign_class_teacher_list/add', [AssignClassTeacherController::class, 'assign_class_teacher_list_insert'])->name('assign_class_teacher.insert');
Route::get('admin/assign_class_teacher_list_edit/edit/{id}', [AssignClassTeacherController::class, 'edit'])->name('assign_class_teacher.edit');
Route::post('admin/assign_class_teacher/{id}/update', [AssignClassTeacherController::class, 'update'])->name('assign_class_teacher.update');
Route::get('admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class, 'delete'])->name('assign_class_teacher.delete');
Route::get('admin/assign_class_teacher_search', [AssignClassTeacherController::class, 'list'])->name('assign_class_teacher.search');


// Home Work Route
Route::get('admin/homework', [HomeWorkController::class, 'index'])->name('admin.homework');
Route::get('admin/homework/fetch-subjects', [HomeWorkController::class, 'fetchHomeWorkSubjects'])->name('admin.fetchHomeworkSubjects');
Route::post('admin/homework', [HomeWorkController::class, 'saveHomeWork'])->name('homework.store');
Route::get('admin/homework/delete/{id}', [HomeWorkController::class, 'delete'])->name('homework.delete');
Route::get('homework/download/{id}', [HomeWorkController::class, 'download'])->name('homework.download');
Route::get('admin/admin_submitted_homework', [HomeWorkController::class, 'adminSubmittedHomework'])->name('admin.admin_submitted_homework');



// Route to display the list of bus schedules
Route::get('/bus_schedules', [BusScheduleController::class, 'BusSchdeule'])->name('admin.bus_schedule_list');
Route::get('/bus_schedules/create', [BusScheduleController::class, 'BusSchdeuleCreate'])->name('admin.bus_schedule_list_create');
Route::post('/bus_schedules', [BusScheduleController::class, 'store'])->name('bus_schedules.store');
Route::get('/bus_schedules/{id}/edit', [BusScheduleController::class, 'edit'])->name('bus_schedules.edit');
Route::post('/bus_schedules/{id}', [BusScheduleController::class, 'update'])->name('bus_schedules.update');
Route::get('/bus_schedules/{id}', [BusScheduleController::class, 'destroy'])->name('bus_schedules.destroy');


// Route to display the list of libraries
Route::get('/libraries', [LibraryController::class, 'index'])->name('admin.library_list');
Route::get('/libraries/create', [LibraryController::class, 'create'])->name('libraries.create');
Route::post('/libraries', [LibraryController::class, 'store'])->name('libraries.store');
Route::get('/libraries/{id}/edit', [LibraryController::class, 'edit'])->name('libraries.edit');
Route::post('/libraries/{id}', [LibraryController::class, 'update'])->name('libraries.update');
Route::get('/libraries/{id}', [LibraryController::class, 'destroy'])->name('libraries.destroy');


// Route to display the list of libraries
Route::get('/admin/bookings', [LibraryController::class, 'showBookings'])->name('admin.booking_list');

// Setting Route
Route::get('admin/setting', [DashboardController::class, 'school_name'])->name('admin.setting');
Route::get('admin/setting/create', [DashboardController::class, 'school_name_create'])->name('admin.setting.create');
Route::post('admin/setting', [DashboardController::class, 'store'])->name('admin.setting.store');
Route::get('admin/setting/{setting}/edit', [DashboardController::class, 'school_name_edit'])->name('admin.setting.edit');
Route::post('admin/setting/{setting}', [DashboardController::class, 'update'])->name('admin.setting.update');
Route::get('admin/setting/{setting}', [DashboardController::class, 'destroy'])->name('admin.setting.destroy');

// Change Password Route
Route::get('admin/change_password', [UserController::class, 'adminPasswordForm']);
Route::post('admin/change_password', [UserController::class, 'update_change_password'])->name('admin.change_password');
Route::post('admin/my_account/{id}', [UserController::class, 'updateMyAccountAdmin']);

});



// Teacher Auth Route

Route::group(['middleware' => 'teacher'], function () {

Route::get('teacher/dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');

// My class & Subject
Route::get('teacher/my_class_subject', [AssignClassTeacherController::class, 'myClassSubject'])->name('teacher.my_class_subject');


// My Student Route
Route::get('teacher/my_student', [StudentController::class, 'MyStudent'])->name('teacher.my_student');


// My Class Time Table Route
Route::get('teacher/my_class_subject/class_timetable/{id}', [TeacherController::class, 'viewClassTimetable'])->name('teacher.class_timetable');


// My Exam Schedule Route
Route::get('teacher/my_exam_schedule', [ExaminationController::class, 'teacherExamSchedule'])->name('teacher.my_exam_schedule');


//My Notice Board Route
Route::get('teacher/my_notice_board_list', [CommunicateController::class, 'MyNoticeBoardTeacher'])->name('teacher.my_notice_board_list');



// teacher side to show student attendance report
Route::get('/teacher/student_attendance_report', [StudentAttendanceController::class, 'teacherStudentAttendanceReport'])->name('teacher.student_attendance_report');






// Teacher Home Work Route
Route::get('/teacher/teacher_home_work', [HomeWorkController::class, 'teacherHomework'])->name('teacher.teacher_home_work');

// Teacher side to show student sumitted homewrok
Route::get('teacher/teacher_submitted_homework', [HomeWorkController::class, 'teacherSubmittedHomework'])->name('teacher.teacher_submitted_homework');




// Change Password Route
Route::get('teacher/change_password', [UserController::class, 'teacherPasswordForm']);
Route::post('teacher/change_password', [UserController::class, 'update_change_password'])->name('teacher.change_password');
// My Account
Route::get('teacher/my_account/', [UserController::class, 'MyAccount'])->name('teacher.my_account');
Route::post('teacher/my_account/', [UserController::class, 'updateMyAccount']);
});







// Student Auth Route


Route::group(['middleware' => 'student'], function () {
 // Student dashboard
Route::get('student/dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');

// My Account
Route::get('student/my_account/', [UserController::class, 'MyAccount'])->name('student.my_account');
Route::post('student/my_account/', [UserController::class, 'UpdateMyAccountStudent']);



// My Subject
Route::get('student/my_subject', [SubjectController::class, 'MySubject'])->name('student.my_subject');

// My Mytime Table
Route::get('student/my_timetable', [ClassTimeTableController::class, 'MytimeTable'])->name('student.my_timetable');


// My Mytime Table
Route::get('student/my_exam_schedule', [ExaminationController::class, 'myExamSchedule'])->name('student.my_exam_schedule');


// My Result
Route::get('student/my_result', [ExaminationController::class, 'myResult'])->name('student.my_result');


Route::get('student/print-results//{examId}/{studentId}', [ExaminationController::class, 'printResults'])->name('print.results');





//My Notice Board Route
Route::get('student/my_notice_board_list', [CommunicateController::class, 'MyNoticeBoardStudent'])->name('student.my_notice_board_list');


// student side to show student attendance report
Route::get('/student/my_attendance', [StudentAttendanceController::class, 'myAttendance'])->name('student.my_attendance');


// Student Home Work Route
Route::get('/student/student_home_work', [HomeWorkController::class, 'studentHomeWork'])->name('student.student_home_work');
Route::get('student/homework/download/{homeworkId}', [HomeWorkController::class, 'download'])->name('homework.download');
Route::get('student/homework/submit/{homeworkId}', [HomeWorkController::class, 'create'])->name('student.homework.create');
Route::post('student/homework', [HomeWorkController::class, 'store'])->name('student.homework.store');
Route::get('student/my_submitted_homework', [HomeWorkController::class, 'mySubmittedHomework'])->name('student.my_submitted_homework');

// My Fees Collection Route
Route::get('student/my_fees', [FeesCollectionController::class, 'myFees'])->name('student.my_fees');

Route::get('/student/library', [LibraryController::class, 'Booking'])->name('student.my_library');
Route::post('/student/library/book', [LibraryController::class, 'BookingStore'])->name('student.library.book');


// bus schedule route
Route::get('/student/my_bus_schedule', [BusScheduleController::class, 'myBusSchedule'])->name('student.my_bus_schedule');

// Change Password Route
Route::get('student/change_password', [UserController::class, 'studentPasswordForm']);
Route::post('student/change_password', [UserController::class, 'update_change_password'])->name('student.change_password');
Route::post('student/assign_subject_list', [UserController::class, 'update_change_password']);
});


Route::group(['middleware' => 'parent'], function () {
Route::get('parent/dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');
// My Account
Route::get('parent/my_account/', [UserController::class, 'MyAccount'])->name('parent.my_account');
Route::post('parent/my_account/', [UserController::class, 'UpdateMyAccountParent']);
// Change Password Route
Route::get('parent/change_password', [UserController::class, 'parentPasswordForm']);
Route::post('parent/assign_subject_list', [UserController::class, 'update_change_password']);


// My Student
// Route::get('parent/parent_student/', [ParentController::class, 'myStudents'])->name('parent.parent_student');


//My Notice Board Route
Route::get('parent/my_notice_board_list', [CommunicateController::class, 'MyNoticeBoardParent'])->name('parent.my_notice_board_list');


// my_student_fees Route
Route::get('parent/my_student_fees', [FeesCollectionController::class, 'showMyStudentFees'])->name('parent.my_student_fees');

// parent side to show my stdent result route
Route::get('/parent/my_student_result/{studentId?}/{examId?}', [ExaminationController::class, 'myStudentResult'])->name('parent.my_student_result');

Route::get('/parent/student-results/print/{studentId}/{examId}', [ExaminationController::class, 'printStudentResult'])->name('parent.print_student_result');

});



// Chat Route
// Route::group(['middleware' => 'common'], function () {

//     Route::get('chat', [ChatController::class, 'Chat'])->name('chat.chat_list');
// });
