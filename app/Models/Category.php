<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ["name",'image',"slug"];
    protected $appends = ['image_url'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('image/'.$this->image);
    }
}
