<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // devo fare un ciclo così da avere project che hanno più technology
        for($i = 0; $i < 50; $i++){

            //prendo un progetto random
            $project = Project::inRandomOrder()->first();
            // dump($project);

            // prendo una tech random
            $technology_id = Technology::inRandomOrder()->first()->id;

            // li unisco con attach
            $project->technologies()->attach($technology_id);
        }
    }
}
