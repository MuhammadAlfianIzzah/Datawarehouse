<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    protected $table = "dw_dim_products";
    protected $fillable = ["id", "nama", "type", "price"];
    use HasFactory;
    public function sold()
    {
        return $this->hasMany(FactSales::class);
    }
}
