<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Type;
use App\Functions\Helper;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creo un array di possibili tipi di progetti
        $data=['App', 'Sito web', 'Web App', 'Database'];

        // per ognuno di questi creo la sua riga nella tabell
        foreach($data as $type){
            $new_type = new Type();
            $new_type->name = $type;
            $new_type->slug = Helper::generateSlug($new_type->name, Type::class);
            // dump($new_type);
            $new_type->save();
        }

    }
}
