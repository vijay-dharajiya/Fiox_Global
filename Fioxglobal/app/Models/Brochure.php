<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    protected $fillable = [
        'title',
        'file_name',
        'file_path',
        'file_size',
    ];
}