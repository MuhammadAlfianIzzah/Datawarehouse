<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    public $incrementing = false;
    protected $table = "dw_dim_dates";
    protected $fillable = ["day_of_weeks", "date", "month", "quarter", "year", "id"];
    use HasFactory;
}
