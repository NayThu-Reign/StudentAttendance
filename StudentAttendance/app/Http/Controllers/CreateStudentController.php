<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;


class CreateStudentController extends Controller
{

    public function add() {
        $classrooms = Classroom::select('name')->groupBy('name')->get();
        $grades = Grade::all();
        $genders = Gender::all();


        return view('admins.student-register', [
            'classrooms' => $classrooms,
            'grades' => $grades,
            'genders' => $genders,
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:students",
            "image" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            "password" => "required|string|min:8|confirmed",
            "gender_id" => "required|exists:genders,id",
            "grade_id" => "required|exists:grades,id",
            "classroom_id" => "required|string",
            "father_name" => "required|string|max:255",
            "address"=> "required|string|max:255",
            "phone_no" => "required|string|max:15",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $imagePath = $request->file('image')->store('student_images', 'public');

        $classroom = Classroom::where('name', $request->classroom_id)->where('grade_id', $request->grade_id)->first();

        if(!$classroom) {
            return back()->withErrors(['classroom_id' => 'Invalid classroom for the selected grade']);
        }

        if (Str::endsWith($request->email, '@admin.gmail.com')) {
            return back()->with('error', "Student email cannot end with '@admin.gmail.com'");
        }

            $student = new Student();
            $student->email =$request->email;
            $student->image = $imagePath;
            $student->name = $request->name;
            $student->gender_id = $request->gender_id;
            $student->password = Hash::make( $request->password);
            $student->grade_id = $request->grade_id;
            $student->classroom_id = $classroom->id;
            $student->father_name = $request->father_name;
            $student->address = $request->address;
            $student->phone_no = $request->phone_no;
            $student->email_verified_at = now();

            $student->save();

            return back()->with('info', 'New Student Added');

    }

    public function edit($id) {
        $student = Student::findOrfail($id);
        $classrooms = Classroom::select('name')->groupBy('name')->get();
        $grades = Grade::all();
        $genders = Gender::all();

        return view('admins.edit-student', [
            'student' => $student,
            'classrooms' => $classrooms,
            'grades' => $grades,
            'genders' => $genders,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "image" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            "password" => "required",
            "grade_id" => "required",
            "gender_id" => "required",
            "classroom_id" => "required",
            "father_name" => "required",
            "address"=> "required",
            "phone_no" => "required",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $imagePath = $request->file('image')->store('student_images', 'public');

        $classroom = Classroom::where('name', $request->classroom_id)->where('grade_id', $request->grade_id)->first();

        if(!$classroom) {
            return back()->withErrors(['classroom_id' => 'Invalid classroom for the selected grade']);
        }

            $student = Student::findOrFail($id);
            $student->email =$request->email;
            $student->image = $imagePath;
            $student->name = $request->name;
            $student->gender_id = $request->gender_id;
            $student->password = Hash::make( $request->password);
            $student->grade_id = $request->grade_id;
            $student->classroom_id = $classroom->id;
            $student->father_name = $request->father_name;
            $student->address = $request->address;
            $student->phone_no = $request->phone_no;
            $student->email_verified_at = now();

            $student->save();

            return redirect("/admin/students/detail/$student->id")->with('msg', 'Student Profile Updated');

    }

}
