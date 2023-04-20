<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ["name", "programming_languages_used", "start_date", "end_date", "description", "type_id", "technologies"];

    // creo una funzione per recuperare il path dell'immagine correttamente 
    public function getImageUri()
    {
        return $this->image ? asset('storage/' . $this->image) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';
    }


    // relazione 1 a molti. Un progetto può avere un solo type

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // relazione 1 a molti. Un progetto può avere un solo type

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
