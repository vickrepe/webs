<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'type',
        'active',
        'order',
        'config',
    ];

    protected $casts = [
        'config' => 'array',
        'active' => 'boolean',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function canBeDeactivated(): bool
    {
        $schema = config("templates.{$this->site->sector}.sections.{$this->type}");

        return ! ($schema['required'] ?? false);
    }
}
