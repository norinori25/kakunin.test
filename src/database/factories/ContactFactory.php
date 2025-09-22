<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'last_name'    => $this->faker->lastName,
            'first_name'   => $this->faker->firstName,
            'gender'       => $this->faker->numberBetween(1, 3),
            'email'        => $this->faker->unique()->safeEmail,
            'tel'          => $this->faker->phoneNumber,
            'address'      => $this->faker->address,
            'building'     => $this->faker->secondaryAddress,
            'detail'      => $this->faker->realText(100),
            'created_at'   => now(),
            'updated_at'   => now(),
            'category_id'  => function(){
                return Category::inRandomOrder()->value('id') ?? 1;
            },
        ];
    }
}
