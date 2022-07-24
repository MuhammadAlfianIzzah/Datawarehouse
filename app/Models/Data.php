<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "time_id", "time",
        "channel_id", "channel_name",
        "customer_id", "customer_name", "customer_type",
        "product_id", "product_name", "product_type", "price",
        "brand_id", "brand_name",
        "quantity", "price_sale",
        "total_sale", "capital_price",
        "cross_income", "capital_total",
        "profit"
    ];
    use HasFactory;
}
