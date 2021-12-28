<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $time = $this->faker->dateTimeBetween($dstartTime='-1week', $endDate='now');
        return [
            'user_id' => User::factory(),
            'start_time' => $time->format('Y-m-d H:i:s'),
            'end_time' => $time->modify('+1hour')->format('Y-m-d H:i:s')
        ];
    }
}
