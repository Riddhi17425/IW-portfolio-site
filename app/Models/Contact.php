<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contact';  // Make sure the table name matches with your database
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'company_name',
        'email',
        'number',
        'interested_in',
        'project_description',
        'venture_or_growth',
        'timeline',
        'budget',
        'extra_details',
        'other_service_details'
    ];
}


