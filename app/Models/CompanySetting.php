<?php
// app/Models/CompanySetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_address',
        'pobox',
        'phone',
        'email',
        'website',
        'tax_id',
        'bank_details',
        'payment_terms'
    ];

    public static function getSettings()
    {
        return self::first() ?? new self();
    }
}