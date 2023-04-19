<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = ['Laravel', 'Vue', 'Angular', 'React', 'MySql',];

        foreach ($options as $option) {
            $technology = new Technology;

            $technology->name = $option;

            $technology->save();
        }
    }
}
