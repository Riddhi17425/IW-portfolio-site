<?php
// app/Models/PortfolioProject.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioProject extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function media()
    {
        return $this->hasMany(PortfolioProjectMedia::class)->orderBy('sort_order');
    }

    // used in edit() -> $selectedIndustryIds
    public function getIndustryIdsArrayAttribute(): array
    {
        return $this->industry_ids
            ? array_map('intval', explode(',', $this->industry_ids))
            : [];
    }

    // used in edit view's window.EXISTING_SERVICES
    public function getServicesArrayAttribute(): array
    {
        return $this->services ? (json_decode($this->services, true) ?: []): [];
    }
}
