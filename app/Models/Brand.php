<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ["name","slug",'image'];
    protected $appends = ['image_url'];

    public function product(){
      return  $this -> haveMany(Product::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('/image/brand/'.$this-> image);
    }
}
