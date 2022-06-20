<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'theme_id'];

    public function theme(){
        return $this->belongsTo(Theme::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
