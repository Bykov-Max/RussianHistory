<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'image',
        'element_id'
    ];

    public function element(){
        return $this->belongsTo(Element::class);
    }
}
