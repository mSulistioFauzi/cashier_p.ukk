<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id', 'product_id', 'amount', 'sub_total'
    ];
}
