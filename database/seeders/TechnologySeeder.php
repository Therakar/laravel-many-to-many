<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Technology::truncate(); //cancella tutti i dati della tabella technologies
        Schema::enableForeignKeyConstraints();

        $technologies = [
            'Html', 
            'CSS', 
            'JS', 
            'Vuejs', 
            'Laravel', 
            'Java', 
            '.NET', 
            'PHP', 
            'Python', 
            'C/C++', 
            'C#'
        ];

        foreach($technologies as $technology) {
            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Str::slug($new_technology->name);
            $new_technology->save();
        }
    }
}