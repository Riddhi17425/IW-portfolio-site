<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeyFeature extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keyfeature';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
}

