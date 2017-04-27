<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $category = [
            'Thịt cá',
            'Rau, củ, quả',
            'Gia vị',
            'Đồ gia dụng',
            'Ăn vặt',
            'Tiền phạt',
            'Khác'
        ];

        for ($i = 0; $i < count($category); $i++) { 
            DB::table('categories')->insert([
                'name' => $category[$i],
                'user_id' => $faker->numberBetween(1, 2)
            ]);
        }
    }
}
