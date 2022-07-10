<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactSales extends Model
{
    public $incrementing = false;
    protected $table = "dw_fact_sales";
    protected $fillable = ["customer_id", "channel_id", "date_id", "product_id", "brand_id", "price_sale", "capital_price", "quantity", "total_sale", "capital_total", "profit"];
    use HasFactory;
    public function date()
    {
        return $this->belongsTo(Date::class, "date_id");
    }
    public function dates()
    {
        return $this->belongsTo(Date::class, "date_id");
    }
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class, "channel_id");
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, "brand_id");
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id");
    }
}
