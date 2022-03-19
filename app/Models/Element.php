<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'back_img',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

}
