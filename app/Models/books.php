<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'category',
        'cover',
        'file',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
