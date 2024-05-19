<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Class_;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if(Auth::guard('web')->check() && Auth::guard('web')->user()) {
                return $next($request);
            }

            abort(403, 'UnAuthorize action');
        })->except('/login');
    }

    public function index() {

        $grades = Grade::all();
        $students = Student::all();
        $admins = User::all();

        return view('admins.index', [
            'grades' => $grades,
            'students' => $students,
            'admins' => $admins,
        ]);
    }

    public function admins() {
        $admins = User::paginate(15);

        return view('admins.admin', [
            'admins' => $admins,
        ]);
    }

    public function student_registeration() {
        $classrooms = Classroom::all();
        $grades = Grade::all();


        return view('admins.student-register', [
            'classrooms' => $classrooms,
            'grades' => $grades,
        ]);
    }

    public function add() {

        return view('admins.admin-register');
    }

    protected function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            "image" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        if (!Str::endsWith($request->email, '@admin.gmail.com')) {
            return back()->with('err', "Email must end with '@admin.gmail.com'");
        }

        $imagePath = $request->file('image')->store('admin_images', 'public');


            $user = new User();
            $user->name = request()->name;
            $user->image = $imagePath;
            $user->email = request()->email;
            $user->email = request()->email;
            $user->password = request()->password;
            $user->email_verified_at = now();

            $user->save();
            return back()->with('success', 'new admin created');

    }



    public function grades() {

        $grades = Grade::paginate(1);


        return view('admins.grade', [

            'grades' => $grades,

        ]);
    }

    public function classroom_detail($id) {
        $classroom = Classroom::findOrFail($id);

        $query = Student::where('grade_id', $classroom->grade_id)
                    ->where('classroom_id', $classroom->id);

        if(request()->has('student')) {
            $query->where('name', 'like', '%' . request()->input('student') . '%');
        }

        if(request()->has('gender_id')) {
            $query->where('gender_id', request()->input('gender_id'));
        }

        $students = $query->paginate(20);

        return view('admins.classroom-detail', [
            'classroom' => $classroom,
            'students' => $students,
            // 'search' => $search,
            // 'searchStudents' => $searchStudents,
        ]);

    }


    public function all_grades(Request $request) {
        $grades = Grade::paginate(1);
        return view('admins.attendances.allgrades', [

            'grades' => $grades,
        ]);
    }

    public function attendance_detail(Request $request, $id) {
        $classroom = Classroom::findOrFail($id);

        $date = $request->query('date') ? Carbon::parse($request->query('date')) : now()->startOfDay();
        $startOfMonth = now()->startOfMonth();

        $earliestDate = $startOfMonth;


        $query = Student::where('grade_id', $classroom->grade_id)
                    ->where('classroom_id', $classroom->id);
                    // ->paginate(20);

        if(request()->has('student')) {
            $query->where('name', 'like', '%' . $request->input('student') . '%');
        }

        if(request()->has('gender_id')) {
            $query->where('gender_id', request()->input('gender_id'));
        }

        $students = $query->paginate(20);

        $attendances = Attendance::whereIn('student_id', $students->pluck('id'))
                    ->whereDate('date', $date->toDateString())
                    ->get()
                    ->groupBy('student_id');

        $presentStudents = Attendance::whereIn('student_id', $students->pluck('id'))
                                        ->whereDate('date', $date->toDateString())
                                        ->where('present', 1)
                                        ->count();




        return view('admins.attendances.attendance-record', [
            'classroom' => $classroom,
            'students' => $students,
            'attendances' => $attendances,
            'date' => $date,
            'earliestDate' => $earliestDate,
            'presentStudents' => $presentStudents,
        ]);
    }

    public function student_detail($id) {
        $student = Student::findOrFail($id);
       $date = now()->startOfDay();

        $presentDays = Attendance::where('student_id', $student->id)
                                    ->whereMonth('date', $date)
                                    ->where('present', 1)
                                    ->count();

        return view('admins.student-detail', [
            'student' => $student,
            'presentDays' => $presentDays,
        ]);
    }



    public function admin_detail($id) {
        $admin = Auth::user();

        return view('admins.admin-detail', [
            'admin' => $admin
        ]);
    }




    public function edit($id) {
        $admin = Auth::user();

        return view('admins.edit-admin', [
            'admin' => $admin
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "image" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            "password" => "required",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $imagePath = $request->file('image')->store('admin_images', 'public');



        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->email =$request->email;
        $admin->image = $imagePath;
        $admin->password = Hash::make( $request->password);
        $admin->email_verified_at = now();

        $admin->save();

        return redirect("/admin/admins/detail/$admin->id")->with('adm', 'Admin Profile Updated');

    }



}
