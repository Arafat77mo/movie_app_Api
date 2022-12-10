<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'title',
        'description',
        'rate',
        'image',
        "category_id"
    ];

    public function Category(){
        return $this->belongsTo(Category::class,"category_id");
    }
}
