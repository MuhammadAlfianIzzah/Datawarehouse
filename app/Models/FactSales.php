<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactSales extends Model
{
    protected $table = "dw_fact_sales";
    protected $fillable = ["customer_id", "channel_id", "date_id", "product_id", "brand_id", "price_sale", "capital_price", "quantity", "total_sale", "capital_total", "profit"];
    use HasFactory;
    public function dates()
    {
        return $this->belongsTo(Date::class, "date_id");
    }
    public function products()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}
