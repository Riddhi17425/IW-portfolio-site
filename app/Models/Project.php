<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    
    public function industry()
{
    return $this->belongsTo(Industry::class, 'industry_id');
}

public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

public function tabings()
{
    $tabingIds = array_values(array_filter(explode(',', (string) $this->tabing_id)));

    if (empty($tabingIds)) {
        return collect();
    }

    return Tabing::whereIn('id', $tabingIds)->get();
}
}
