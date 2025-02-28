<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{

    protected $table = 'sales';

    use HasFactory;

    protected $fillable = [
        'sale_date',
        'total_price',
        'total_pay',
        'total_return',
        'customer_id',
        'user_id',
        'poin',
        'total_poin',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function details()
    {
        return $this->hasMany(DetailSale::class, 'sale_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
