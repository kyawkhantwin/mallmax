<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ["color","slug"];

    public function product()
    {
        return $this ->belongsToMany(Color::class,'product_colors');
    }
}
