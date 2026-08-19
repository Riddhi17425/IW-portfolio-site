<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    use SoftDeletes;
    protected $fillable = [
        'service_title',
        'timeline_title',
        'budget',
    ];

    protected $casts = [
        'service_title' => 'array',
        'timeline_title' => 'array',
        'budget' => 'array',
    ];
}
 