<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable =[
        'uername',
        'password',
        'name',
        'position',
        'number',
        'tel'
    ];
}
