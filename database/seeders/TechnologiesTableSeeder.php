<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper;
use App\Models\Technology;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'Vite', 'Frontend', 'Backend'];

        foreach($data as $technology){
            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Helper::generateSlug($new_technology->name, Technology::class);
            $new_technology->save();
        }
    }
}
