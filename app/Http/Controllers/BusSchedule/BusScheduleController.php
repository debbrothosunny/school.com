<?php

namespace App\Http\Controllers\BusSchedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassName;
use App\Models\BusSchedule;
use Illuminate\Support\Facades\Auth;

class BusScheduleController extends Controller
{
    public function BusSchdeule()
    {
        $busSchedules = BusSchedule::where('status', 1)->paginate(10);
        return view('admin.bus_schedule_list', compact('busSchedules'));
    }

    public function BusSchdeuleCreate()
    {
        $classes = ClassName::all();
        return view('admin.bus_schedule_list_create', compact('classes'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'bus_number' => 'required',
            'route_name' => 'required',
            'driver_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'start_location' => 'required',
            'end_location' => 'required',
            'days_of_operation' => 'required',
            'capacity' => 'required|integer',
            'contact_number' => 'required',
        ]);

        BusSchedule::create($request->all());

        return redirect()->route('admin.bus_schedule_list')->with('success', 'Bus schedule created successfully.');
    }


    public function edit($id)
    {
        $busSchedule = BusSchedule::findOrFail($id);
        $classes = ClassName::all();
        return view('admin.bus_schedule_list_edit', compact('busSchedule', 'classes'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required',
            'bus_number' => 'required',
            'route_name' => 'required',
            'driver_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'start_location' => 'required',
            'end_location' => 'required',
            'days_of_operation' => 'required',
            'capacity' => 'required|integer',
            'contact_number' => 'required',
        ]);

        $busSchedule = BusSchedule::findOrFail($id);
        $busSchedule->update($request->all());

        return redirect()->route('admin.bus_schedule_list')->with('success', 'Bus schedule updated successfully.');
    }

    public function destroy($id)
    {
        $busSchedule = BusSchedule::findOrFail($id);
        $busSchedule->delete();

        return redirect()->route('admin.bus_schedule_list')->with('success', 'Bus schedule deleted successfully.');
    }


    // 

    public function myBusSchedule()
    {
        $student = Auth::user()->student;// Assuming the student is logged in
        // Fetch bus schedules assigned to the student's class or any relevant criteria
        $busSchedules = BusSchedule::where('class_id', $student->class_id)->get();
        
        return view('student.my_bus_schedule', compact('busSchedules'));
    }
}
