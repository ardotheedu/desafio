<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'document',
        'email',
        'phone',
        'address'
    ];

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
