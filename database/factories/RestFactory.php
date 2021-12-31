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
        // $rest = Attendance::factory()->start_time->modify('+1hour');
        // $attendance_id = Attendance::factory();
        // $rest = Attendance::find($attendance_id)->start_time;
        // $attendance_id = Attendance::factory()->id()->get();
        // $rest = Rest::wherenull('end_time')->first();
        $attendance = Attendance::wherenotnull('start_time')->latest('id')->first();
        $attendance_id = $attendance['id'];
        $rest = Attendance::find($attendance_id);
        $rest = $rest['start_time'];

        return [
            // 'attendance_id' => Attendance::factory(),
            // 'start_time' => function(array $attributes){
            //     return Attendance::find($attributes[$attendance_id])->start_time->modify('+1hour')->format('Y-m-d H:i:s');
            // },
            // 'end_time' => function(array $attributes){
            //     return Attendance::find($attributes[$attendance_id])->start_time->modify('+3hour')->format('Y-m-d H:i:s');
            // },
            // 'start_time' => Attendance::find($attendance_id)->start_time->modify('+1hour')->format('Y-m-d H:i:s'),
            // 'end_time' => Attendance::find($attendance_id)->start_time->modify('+3hour')->format('Y-m-d H:i:s')

            // 'start_time' => Attendance::find($rest['attendance_id'])->start_time->modify('+1hour')->format('Y-m-d H:i:s'),
            // 'end_time' => Attendance::find($rest['attendance_id'])->start_time->modify('+3hour')->format('Y-m-d H:i:s'),

            'start_time' => date('Y-m-d H:i:s', strtotime("$rest +1 hour")),
            'end_time' => date('Y-m-d H:i:s', strtotime("$rest +3 hour")),

        ];
    }
}
