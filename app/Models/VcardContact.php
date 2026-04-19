<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VcardContact extends Model
{
    protected $table = 'vcard_contacts';

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'address',
        'organization',
        'job_title',
    ];
}
