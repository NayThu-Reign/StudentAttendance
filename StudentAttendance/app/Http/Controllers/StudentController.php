<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;
use App\Models\Student;
use Carbon\Carbon;

class StudentController extends Controller
{

    public function __construct() {
        $this->middleware(function($request, $next) {
            if(Auth::guard('student')->check() && Auth::guard('student')->user()) {
                return $next($request);
            }

            return redirect('/login');
        })->except('/login');
    }



    public  function index(Request $request) {

        $date = $request->query('date') ? Carbon::parse($request->query('date')) : now()->startOfDay();
        $startOfMonth = now()->startOfMonth();
        $earliestDate = $startOfMonth;



        $student = Auth::guard('student')->user();
        $studentAttendance = Attendance::where('student_id', $student->id)
                                        ->whereDate('date', $date->toDateString())
                                        ->get();


        $gradeId = $student->grade_id;
        $classroomId = $student->classroom_id;


        $classmates = Student::where('grade_id', $gradeId)
                             ->where('classroom_id', $classroomId)
                             ->where('id', '!=', $student->id)
                             ->get();

        $classmateAttendances = Attendance::whereIn('student_id', $classmates->pluck('id'))
                    ->whereDate('date', $date->toDateString())
                    ->get()
                    ->groupBy('student_id');


        $earliestDate = $startOfMonth;


        return view("index", [
            'date' => $date,
            'startOfMonth' => $startOfMonth,
            'earliestDate' => $earliestDate,

            'classmateAttendances' => $classmateAttendances,
            'studentAttendance' => $studentAttendance,
            'student' => $student,

            'classmates' => $classmates,

        ]);
    }

    public function timeIn() {
        $student = Auth::guard('student')->user();

       $date = now()->startOfDay();

       Attendance::updateOrCreate(
        ['student_id' => $student->id, 'date' => $date],
        ['time_in' => now()],
       );

       return back();
    }

    public function timeOut() {
        $student = Auth::guard('student')->user();
       $date = now()->startOfDay();

       $attendance = Attendance::where('student_id', $student->id)
                                ->whereDate('date', $date)
                                ->first();

        if($attendance) {
            $attendance->update([
                'time_out' => now(),
                'present' => 1,
                'status' => 'present'
            ]);
        }

        return back();

    }


}
