<?php

namespace Database\Factories;

use App\Models\InfoRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfoRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InfoRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->company(),
            'annual_income' => $this->faker->numberBetween(10000, 100000),
            'contact_name' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->email(),
            'message' => $this->faker->text(),
            'legal_terms' => 1,
            'is_managed' => $this->faker->numberBetween(0, 1),
        ];
    }
}
