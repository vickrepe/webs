<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogVariant extends Model
{
    protected $fillable = [
        'sector_id', 'key', 'label', 'color', 'typography',
        'placeholder', 'defaults', 'theme_colors', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'typography'   => 'array',
        'defaults'     => 'array',
        'theme_colors' => 'array',
        'is_active'    => 'boolean',
    ];

    public function sector()
    {
        return $this->belongsTo(CatalogSector::class, 'sector_id');
    }
}
