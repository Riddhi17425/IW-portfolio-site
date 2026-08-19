<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectInquiry extends Model
{
    protected $table = 'connect_inquiries';

    protected $fillable = [
        'name',
        'contact_number',
        'country_code',
        'email',
        'message',
    ];
}