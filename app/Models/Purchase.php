<?php

namespace App\Models;

use App\Enums\PurchaseStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'supplier_id',
        'date',
        'purchase_no',
        'status',
        'total_amount',
        'paying_amount',
        'due',
        'created_by',
        'updated_by',
        'user_id',
        'uuid',
    ];

    protected $casts = [
        'date'       => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status'     => PurchaseStatus::class,
        'paying_amount'       => 'float', // Ensure 'paid' attribute is cast to float
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(PurchaseDetails::class);
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('purchase_no', 'like', "%{$value}%")
            ->orWhere('status', 'like', "%{$value}%");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
