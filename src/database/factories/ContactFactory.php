<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'gender' => ['required', 'integer'],
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'tel' => $this->faker->tel(),
            'address' => $this->faker->address(),
            'building' => $this->faker->building(),
            'category' => $this->faker->randomElements('商品のお届けについて','商品の交換について','商品トラブル','ショップへのお問い合わせ','その他'),
            'detail' => $this->faker->text(120),
        ];
    }
}
