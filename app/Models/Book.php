<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title','image'
    ];

    public function user():BelongsToMany{
        return $this->belongsToMany(User::class);
        return $this->belongsToMany(User::class, 'book_user');
    }
}
