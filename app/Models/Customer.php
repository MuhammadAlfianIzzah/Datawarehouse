<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $incrementing = false;
    protected $table = "dw_dim_customers";
    protected $fillable = ["id", "nama", "type"];
    use HasFactory;
}
