<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    
    protected $fillable = [
        'full_name',
        'company_name',
        'phone',
        'email',
        'product_id',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
