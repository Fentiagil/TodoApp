<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Todo', 'created_by' => 1],
            ['name' => 'InProgress', 'created_by' => 1],
            ['name' => 'Testing', 'created_by' => 1],
            ['name' => 'Done', 'created_by' => 1],
            ['name' => 'Pending', 'created_by' => 1],
        ];

        DB::table('categories')->insert($categories);
    }
}
