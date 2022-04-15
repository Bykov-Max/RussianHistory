<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'element_id',
        'user_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function element(){
        return $this->belongsTo(Element::class);
    }
}
