<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'biller',
        'customer',
        'sale_status',
        'payment_status',
        'delivery_status',
        'grand_total',
        'returned_amount',
        'paid',
        'due',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the sale items for the sale.
     */
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
