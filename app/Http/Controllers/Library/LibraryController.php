<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Library;
use App\Models\Booking;
use DB;


class LibraryController extends Controller
{
    public function index()
    {
        $books = Library::all();
        return view('admin.library_list', compact('books'));
    }

    // Show the form for creating a new book
    public function create()
    {
        return view('admin.library_list_create');
    }

    // Store a newly created book in the database
    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'isbn' => 'required|unique:libraries,isbn',
            'published_year' => 'required|digits:4|integer|min:1500|max:' . (date('Y')),
            'category' => 'required',
            'language' => 'required',
            'copies_available' => 'required|integer|min:0',
        ]);

        $library = new Library();
        $library->book_title = $request->book_title;
        $library->author = $request->author;
        $library->publisher = $request->publisher;
        $library->isbn = $request->isbn;
        $library->published_year = $request->published_year;
        $library->category = $request->category;
        $library->language = $request->language;
        $library->copies_available = $request->copies_available;
        $library->created_by = auth()->id(); // Assuming user authentication
        $library->status = $request->status;
        $library->save();

        return redirect()->route('admin.library_list')->with('success', 'Book added successfully.');
    }

    // Show the form for editing a specific book
    public function edit($id)
    {
        $books = Library::findOrFail($id);
        return view('admin.library_list_edit', compact('books'));
    }


    // Update the specified book in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'book_title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'isbn' => 'required|unique:libraries,isbn,' . $id,
            'published_year' => 'required|digits:4|integer|min:1500|max:' . (date('Y')),
            'category' => 'required',
            'language' => 'required',
            'copies_available' => 'required|integer|min:0',
        ]);

        $library = Library::findOrFail($id);

        $library->book_title = $request->book_title;
        $library->author = $request->author;
        $library->publisher = $request->publisher;
        $library->isbn = $request->isbn;
        $library->published_year = $request->published_year;
        $library->category = $request->category;
        $library->language = $request->language;
        $library->copies_available = $request->copies_available;
        $library->status = $request->status;
        $library->save();

        return redirect()->route('admin.library_list')->with('success', 'Book updated successfully.');
    }

    // Remove the specified book from the database
    public function destroy($id)
    {
        $library = Library::findOrFail($id);
        $library->delete();

        return redirect()->route('admin.library_list')->with('success', 'Book deleted successfully.');
    }

    // Student Side to Booking Book

     // Display all available books
     public function booking()
     {
         // Get the current student's ID
         $studentId = Auth::user()->student->id; // Assuming Auth::user()->student returns the student instance
     
         // Retrieve available books and also check if the student has booked them
         $books = Library::where('status', 'available')
             ->leftJoin('bookings', function($join) use ($studentId) {
                 $join->on('libraries.id', '=', 'bookings.book_id')
                     ->where('bookings.student_id', '=', $studentId);
             })
             ->select('libraries.*', 'bookings.book_id as booked')
             ->get();
     
         return view('student.my_library', compact('books'));
     }

    // Store the booking
    public function BookingStore(Request $request)
    {
        // Validate request data
        $request->validate([
            'book_id' => 'required|exists:libraries,id',
            'return_date' => 'required|date|after_or_equal:today' // Ensure return_date is valid
        ]);
    
        // Get the authenticated student
        $student = Auth::user()->student;
    
        // Check if student exists
        if (!$student) {
            return redirect()->back()->with('error', 'Student record does not exist.');
        }
    
        // Check if the book is available
        $book = Library::find($request->book_id);
        if (!$book || $book->copies_available <= 0) {
            return redirect()->back()->with('error', 'Book is not available for booking.');
        }
    
        // Create a booking record
        Booking::create([
            'student_id' => $student->id,
            'book_id' => $request->book_id,
            'booking_date' => now(), // Current date as booking date
            'return_date' => $request->return_date,
        ]);
    
        // Update the book availability
        $book->copies_available -= 1;
        if ($book->copies_available == 0) {
            $book->status = 'unavailable';
        }
        $book->save();
    
        return redirect()->back()->with('success', 'Book booked successfully.');
    }
    
    
    


    // Admin Side show which student booking book
    public function showBookings()
    {
        // Retrieve all bookings with related student and book information using eager loading
        $bookings = Booking::with([
            'student' => function($query) {
                $query->select('id', 'first_name', 'last_name');
            },
            'book' => function($query) {
                $query->select('id', 'book_title');
            }
        ])->select('id', 'student_id', 'book_id', 'booking_date', 'return_date')->get();

        return view('admin.booking_list', compact('bookings'));
    }

}
