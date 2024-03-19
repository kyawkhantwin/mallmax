<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ["name","photo","email","password"];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function transaction()
    {
        return $this->hasMany(ProductAddTransaction::class);
    }

    public function order()
    {
        return $this ->hasMany(Product::class);
    }
}
