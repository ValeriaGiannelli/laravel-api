<?php
namespace App\Functions;

use Illuminate\Support\Str;

class Helper{
    // funzione per lo slug
    public static function generateSlug($string, $model){
        // variabile che prenda la stringa e sostituisca gli spazi col trattino
        $slug = Str::slug($string, '-');

        // variabile aggiuntiva per il ciclo while
        $original_slug = $slug;

        // se trovo uno slug esistente $exists non sarà null
        $exists = $model::where('slug', $slug)->first();

        // inizializzo un contatore
        $c = 1;
        // queso ciclo partirà solo se lo slug non è null, quindi c'è
        while($exists){
            // concatena il contatore
            $slug = $original_slug . '-' . $c;
            // ricontrolla che anche questo slug non esiste
            $exists = $model::where('slug', $slug)->first();
            // se esiste aumenta il contatore di 1
            $c++;
        }

        return $slug;
    }
}
