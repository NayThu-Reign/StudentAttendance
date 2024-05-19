<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use PhpParser\Builder\Class_;
use PHPUnit\Framework\MockObject\Builder\Stub;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $gradeList = ['9th', '10th', '11th', '12th'];
        $classroomList = ['A', 'B', 'C', 'D'];


        $gradeIds = [];
        foreach($gradeList as $name) {
            $grade = Grade::create(['name' => $name]);
            $gradeIds[] = $grade->id;
        }

        foreach($gradeIds as $gradeId) {
            foreach($classroomList as $name) {
                Classroom::create([
                    'name' => $name,
                    'grade_id' => $gradeId,
                ]);
            }
        }

        $genderList = ['male', 'female'];

        foreach($genderList as $name) {
            Gender::create([
                'name' => $name,
            ]);
        }

        Student::create([
            'name' => 'Kyaw Kyaw',
            'email' => 'kyawkyaw@gmail.com',
            'gender_id' => 1,
            'grade_id' => 1,
            'classroom_id' => 1,
            'father_name' => 'U Ba',
            'address' => 'Yangon',
            'phone_no' => '098873432',
            'email_verified_at' => now(),
            'password' => 'password',
        ]);

        Student::create([
            'name' => 'Mg Mg',
            'email' => 'mgmg@gmail.com',
            'gender_id' => 1,
            'grade_id' => 1,
            'classroom_id' => 1,
            'father_name' => 'U Mya',
            'address' => 'Yangon',
            'phone_no' => '098873456',
            'email_verified_at' => now(),
            'password' => 'password',
        ]);

        User::create([
            'name' => 'James',
            'email' => "james@admin.gmail.com",
            'password' => 'password',
            'email_verified_at' => now(),
        ]);

        Student::factory()->count(120)->create();

        // Attendance::create([
        //     'student_id' => 1,
        //     'date' => now()->toDateString(),
        //     'time_in' => now()->toTimeString(),
        //     'time_out' => now()->toTimeString(),
        //     'status' => 'present',
        // ]);

        Attendance::create([
            'student_id' => 2,
            'date' => now()->toDateString(),
            'time_in' => now()->toTimeString(),
            'time_out' => now()->toTimeString(),
            'present' => 1,
            'status' => 'present',
        ]);
    }
}
