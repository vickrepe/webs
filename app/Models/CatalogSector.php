<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogSector extends Model
{
    protected $fillable = ['key', 'label', 'icon', 'template_key', 'sort_order'];

    public function variants()
    {
        return $this->hasMany(CatalogVariant::class, 'sector_id')->orderBy('sort_order');
    }
}
