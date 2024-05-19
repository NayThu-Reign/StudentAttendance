<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Grade;
use App\Models\Classroom;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $grade = Grade::inRandomOrder()->first();
        $classroom = Classroom::where('grade_id', $grade->id)->inRandomOrder()->first();
        // $genders = ['male', 'female'];

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'gender_id' => rand(1,2),
            'grade_id' => $grade->id,
            'classroom_id' => $classroom->id,
            'father_name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone_no' => $this->faker->phoneNumber,
            'email_verified_at' => null,
            'password' => Hash::make('password'),

        ];
    }
}
