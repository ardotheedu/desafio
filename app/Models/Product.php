<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'average_price',
        'stock'
    ];

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
