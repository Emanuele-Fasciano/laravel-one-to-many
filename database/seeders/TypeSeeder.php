<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = ['front-end', 'back-end', 'full-stack'];

        foreach ($options as $option) {
            $type = new Type;

            $type->type_of_stack = $option;

            $type->save();
        }
    }
}
