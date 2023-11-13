<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'self_link',
        'text'
    ];
    protected $table = ['questions'];

}
