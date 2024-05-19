<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    /*
    inverse belongsTo
    cette catégorie va avoir plusieurs articles
    */
    public function posts()
    {
        return $this->HasMany(Post::class);
    }
}
