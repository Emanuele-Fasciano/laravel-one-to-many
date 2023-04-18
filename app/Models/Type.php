<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ["type_of_stack",];

    // relazione 1 a molti. 1 type può avere molti progetti

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
