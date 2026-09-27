<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationImage extends Model
{
    protected $fillable = ['application_id', 'title', 'description', 'image'];
}