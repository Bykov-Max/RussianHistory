<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = false;


    public function messages(){
        return $this->hasMany(Message::class);
    }
}
