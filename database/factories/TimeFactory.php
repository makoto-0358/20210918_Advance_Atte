<?php

namespace Database\Factories;

use App\Models\Time;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Time::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => AtteUser::factory(),
            'user_name' => function(array $atteusers){
                return AtteUser::find($atteusers['user_id'])->name;
            },
            'date' => $this->faker->dateTimeBetween($startDate='-10years', $endDate='+10years')->format('Y-m-d'),
            'start_time' => $this->faker->dateTimeBetween($dstartTime='-10years', $endDate='+10years')->format('H:i:s'),
            'closing_time' => $this->faker->dateTimeBetween($dstartTime='-10years', $endDate='+10years')->format('H:i:s'),
            'break_times' => $this->faker->dateTimeBetween($dstartTime='-10years', $endDate='+10years')->format('H:i:s')
        ];
    }
}
