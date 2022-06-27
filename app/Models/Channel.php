<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public $incrementing = false;
    protected $table = "dw_dim_channels";
    protected $fillable = ["id", "nama"];
    use HasFactory;
}
