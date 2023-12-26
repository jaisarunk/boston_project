<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    public $table ='forms';
    protected $fillable = [
        'book_name',
        'author_name',
        'price',
        'language',
        'access',
        'country',
        'image',
    ];
}
