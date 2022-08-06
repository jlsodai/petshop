<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Uuids;

    protected $casts = [
        "address" => "array",
        "products" => "array",
        "shipped_at" => "datetime"
    ];
}
