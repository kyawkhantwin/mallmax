<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;
    protected $fillable=['user_id',"product_id","total_qty","sale_price"];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }
    public function product()
    {
        return $this -> belongsTo(Product::class);
    }
    public function transaction()
    {
        return $this -> belongsTo(ProductAddTransaction::class);
    }
}
