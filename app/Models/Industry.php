<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Industry extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'industry';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

   public function category()
    {
        return $this->belongsTo(Category::class);
    }

  
}
