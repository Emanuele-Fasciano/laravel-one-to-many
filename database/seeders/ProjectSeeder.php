<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all()->pluck('id');

        $types[] = null;

        for ($i = 0; $i < 30; $i++) {
            $project = new Project;
            $project->name = $faker->words(3, true);
            $project->type_id = $faker->randomElement($types);
            $project->description = $faker->paragraph(5, false);
            $project->start_date = $faker->dateTimeThisYear();
            $project->end_date = $faker->dateTimeInInterval($project->start_date, '+1 week');
            // $project->image = $faker->imageUrl(360, 360, 'animals', true, 'cats');
            $project->save();
        }
    }
}
