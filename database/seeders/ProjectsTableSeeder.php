<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Generator as Faker;
use App\Functions\Helper;
use App\Models\Type;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 50; $i++){
            $new_project = new Project();
            // aggiungo randomicamente i miei alementi dei typi nella colonna type_id
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            // dump(Type::inRandomOrder()->first()->id);
            $new_project->title = $faker->sentence();
            $new_project->start_date = $faker->dateTimeBetween('-1 month', 'now');
            $new_project->end_date = $faker->dateTimeBetween('now', '1 year');
            $new_project->slug = Helper::generateSlug($new_project->title, Project::class);
            $new_project->description = $faker->sentence();
            // dump($new_project);
            $new_project->save();
        }
    }
}
