<?php

namespace Database\Factories;

use App\Models\Attendance;
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
            'user_name' => function(array $attributes){
                return User::find($attributes['user_id'])->name;
            },
            'start_time' => $time->format('H:i:s'),
            'end_time' => $time->modify($dstartTime='+5hour', $endDate='+12hour')->format('H:i:s')
        ];
    }
}
