<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CollectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 20) as $index) {
            DB::table('collects')->insert([
                'price' => $faker->numberBetween(100, 300) * 1000,
                'user_id' => $faker->numberBetween(1, 2),
                'created_at' => Carbon::createFromTimestamp(
                    rand(strtotime('2017-04-23'), strtotime('2016-01-01')))
                    ->format('Y-m-d h:i:s')
            ]);
        }
    }
}
