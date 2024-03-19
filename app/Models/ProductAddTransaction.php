<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAddTransaction extends Model
{
    use HasFactory;
    protected $fillable = ["order_id","user_id","product_id","sale_price",'total_qty'];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }
    public function supplier()
    {
        return $this -> belongsTo(Supplier::class);
    }
    public function product()
    {
        return $this -> belongsTo(Product::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
