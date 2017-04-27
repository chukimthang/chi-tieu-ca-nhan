<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $index) {
            DB::table('expenses')->insert([
                'name' => str_random(10),
                'price' => $faker->numberBetween(10, 100) * 1000, 
                'description' => $faker->text(200),
                'category_id' => $faker->numberBetween(1, 7),
                'user_id' => $faker->numberBetween(1, 2), 
                'created_at' => Carbon::createFromTimestamp(
                    rand(strtotime('2017-04-23'), strtotime('2016-01-01')))
                    ->format('Y-m-d h:i:s')
            ]);
        }
    }
}
