<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $fillable = ["user_id","supplier_id","product_cart","total_price"];

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
        return $this -> hasMany(Product::class);
    }
}
