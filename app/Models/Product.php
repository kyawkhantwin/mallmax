<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["category_id","brand_id","name",'slug',"description","image",'image_url',"total_qty","sale_price","discount_price"];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('/image/product/'.$this->image);
    }
    public function brand()
    {
        return $this -> belongsTo(Brand::class);
    }
    public function category()
    {
        return $this -> belongsTo(Category::class);
    }

    public function color()
    {
        return $this -> belongsToMany(Color::class);
    }

    public function supplier()
    {
        return $this -> belongsTo(Supplier::class);
    }
    public function transaction()
    {
        return $this->hasMany(ProductAddTransaction::class);
    }

    public function cart()
    {
        return $this -> belongsTo(ProductCart::class);
    }

    public function review()
    {
        return $this ->hasMany(ProductReview::class);
    }
}
