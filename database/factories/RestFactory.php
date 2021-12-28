<?php

namespace Database\Factories;

use App\Models\Rest;
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
        $time = $this->faker->dateTimeBetween($dstartTime='+1hour', $endDate='3hour');
        return [
            'attendance_id' => Attendancer::factory(),
            'start_time' => $time->format('H:i:s'),
            'end_time' => $time->modify($dstartTime='+1hour', $endDate='+2hour')->format('H:i:s')
        ];
    }
}
