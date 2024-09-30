<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    // funzione per mettere in relazione un type con many projects
    public function projects(){
        return $this->hasMany(Project::class);
    }
}
