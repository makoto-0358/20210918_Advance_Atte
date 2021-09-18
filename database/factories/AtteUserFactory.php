<?php

namespace Database\Factories;

use App\Models\AtteUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtteUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AtteUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'mail' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password()
        ];
    }
}
