<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // champs remplissable
    protected $fillable = [
        'title',
        'slug',
        'content'
    ];

    // propriété inversée pas autorisé
    // protected $guarded = [];
}
