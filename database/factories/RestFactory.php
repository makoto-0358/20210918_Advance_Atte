<?php

namespace Database\Factories;

use App\Models\Rest;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attendance = Attendance::wherenotnull('start_time')->latest('id')->first();
        $attendance_id = $attendance['id'];
        $rest = Attendance::find($attendance_id);
        $rest = $rest['start_time'];

        return [
            'start_time' => date('Y-m-d H:i:s', strtotime("$rest +1 hour")),
            'end_time' => date('Y-m-d H:i:s', strtotime("$rest +3 hour")),
        ];
    }
}
