<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = ["tanggal", "channel_id", "channel", "customer_id", "customer_name", "costumer_type", "product_id", "product_name", "product_type", "price", "brand_id", "brand", "quantity", "price_sale", "total", "capital_price", "cross_income", "total_capital", "profit"];
    use HasFactory;
}
