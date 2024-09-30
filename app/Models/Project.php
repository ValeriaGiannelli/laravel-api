<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;
use App\Models\Technology;

class Project extends Model
{
    use HasFactory;
    protected $casts = [
        "start_date" => "datetime",
        "end_date" => "datetime",
    ];

    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'slug',
        'description',
        'type_id',
        'img_path',
        'img_original_name'
    ];

    // funzione per mettere in relazione Project con Type
    public function type(){
        return $this->belongsTo(Type::class);
    }


    // funzione per relazione con tabella Pivor
    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
}
