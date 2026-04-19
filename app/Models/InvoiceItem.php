<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product',
        'qty',
        'rate',
        'amount',
    ];

    protected $casts = [
        'qty' => 'decimal:2',
        'rate' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the invoice that owns the item
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get formatted quantity
     */
    public function getFormattedQtyAttribute()
    {
        return number_format($this->qty, 2);
    }

    /**
     * Get formatted rate
     */
    public function getFormattedRateAttribute()
    {
        return 'Tsh ' . number_format($this->rate, 2);
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute()
    {
        return 'Tsh ' . number_format($this->amount, 2);
    }

    /**
     * Calculate amount before saving
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            // Auto-calculate amount if qty or rate changes
            if ($item->isDirty(['qty', 'rate'])) {
                $item->amount = $item->qty * $item->rate;
            }
        });
    }
}