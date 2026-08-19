<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    public function industries()
    {
        return $this->hasMany(Industry::class);
    }

    public function tabings()
    {
        return $this->hasMany(Tabing::class);
    }

}
