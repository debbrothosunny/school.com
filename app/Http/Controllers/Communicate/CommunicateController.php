<?php

namespace App\Http\Controllers\Communicate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NoticeBoard;
use App\Models\NoticeBoardMessage;
use Auth;

class CommunicateController extends Controller
{
    public function NoticeBoard(Request $request)
    {
        $query = NoticeBoard::query();
    
        if ($request->has('title') && $request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
    
        if ($request->has('notice_date') && $request->notice_date) {
            $query->whereDate('notice_date', $request->notice_date);
        }
    
        if ($request->has('publish_date') && $request->publish_date) {
            $query->whereDate('publish_date', $request->publish_date);
        }
    
        // Paginate results, adjust the number as needed
        $notices = $query->orderBy('publish_date', 'desc')->paginate(15);
    
        $data['header_title'] = 'Notice Board List';
    
        return view('admin.communicate.notice_board.notice_board_list', compact('notices', 'data'));
    }


    public function NoticeBoardAdd()
    {
        return view('admin.communicate.notice_board.notice_board_list_add');
    }

    public function NoticeBoardStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'notice_date' => 'required|date',
            'publish_date' => 'required|date',
            'message' => 'required',
            'message_to' => 'required|array', // Ensure message_to is an array
        ]);

        // Create a new NoticeBoard instance
        $noticeBoard = new NoticeBoard();

        // Assign validated data to the model instance
        $noticeBoard->title = $request->title;
        $noticeBoard->notice_date = $request->notice_date;
        $noticeBoard->publish_date = $request->publish_date;
        $noticeBoard->message = $request->message;
        $noticeBoard->created_by = Auth::user()->id; // Assuming you have authentication set up

        $noticeBoard->save();

        // Attach message_to relationships
        $messageTo = $request->input('message_to');
        foreach ($messageTo as $recipientId) {
            $noticeBoardMessage = new NoticeBoardMessage([
                'notice_board_id' => $noticeBoard->id,
                'message_to' => $recipientId,
            ]);
            $noticeBoardMessage->save();
        }

        return redirect()->route('admin.notice_board_list')->with('success', 'Notice created successfully.');
    }


    public function NoticeBoardEdit($id)
    {
        $notice = NoticeBoard::findOrFail($id);
        $messageTo = $notice->NoticeBoardMessage()->pluck('message_to')->toArray(); // Fetch related data correctly

        $header_title = 'Edit Notice Board'; // Adjust header title as needed

        return view('admin.communicate.notice_board.notice_board_list_edit', compact('notice', 'header_title', 'messageTo'));
    }


    public function NoticeBoardUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'notice_date' => 'required|date',
            'publish_date' => 'required|date',
            'message' => 'required',
        ]);

        $notice = NoticeBoard::findOrFail($id);
        $notice->title = $request->title;
        $notice->notice_date = $request->notice_date;
        $notice->publish_date = $request->publish_date;
        $notice->message = $request->message;
        $notice->save();

        // Update message_to if needed
        // Assuming message_to is an array of values from checkboxes
        $messageTo = $request->input('message_to', []);
        $notice->NoticeBoardMessage()->delete(); // Remove all existing associations
        foreach ($messageTo as $recipientId) {
            $notice->NoticeBoardMessage()->create([
                'notice_board_id' => $notice->id,
                'message_to' => $recipientId,
            ]);
        }

        return redirect()->route('admin.notice_board_list')->with('success', 'Notice updated successfully.');
    }


    public function NoticeBoardDelete($id)
    {
        $notice = NoticeBoard::findOrFail($id);
        $notice->delete();

        return redirect()->route('admin.notice_board_list')->with('success', 'Notice deleted successfully.');
    }



    // Student Side to Show Notice Board

    public function MyNoticeBoardStudent()
    {
        $notices = NoticeBoard::whereHas('NoticeBoardMessage', function ($query) {
            $query->where('message_to', 3); // Assuming 3 is the value for Student
        })->get();

        $data['header_title'] = 'Student Notice Board List';
        return view('student.my_notice_board_list', compact('notices', 'data'));
    }


    // Teacher Side to Show Notice Board

    public function MyNoticeBoardTeacher()
    {
        // Assuming NoticeBoardMessage model has a 'message_to' column
        $getRecord = NoticeBoard::whereHas('NoticeBoardMessage', function ($query) {
            $query->where('message_to', 2); // Assuming 2 is the ID for teachers
        })->get();

        $data['header_title'] = 'Teacher Notice Board';

        return view('teacher.my_notice_board_list', compact('getRecord', 'data'));
    }


    public function MyNoticeBoardParent()
    {
        // Assuming NoticeBoardMessage model has a 'message_to' column
        $getRecord = NoticeBoard::whereHas('NoticeBoardMessage', function ($query) {
            $query->where('message_to', 4); // Assuming 4 is the ID for parents
        })->get();

        $data['header_title'] = 'Parent Notice Board';

        return view('parent.my_notice_board_list', compact('getRecord', 'data'));
    }
}
