<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'sector',
        'status',
        'logo_url',
        'config',
        'custom_domain',
        'domain_verified',
    ];

    protected $casts = [
        'config'          => 'array',
        'domain_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function bookingSetting(): HasOne
    {
        return $this->hasOne(BookingSetting::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function sections()
    {
        return $this->hasMany(SiteSection::class)->orderBy('order');
    }

    public function planAllows(string $feature): bool
    {
        return config("plans.{$this->user->plan}.{$feature}", false);
    }

    public function atLimit(string $limitKey, int $current): bool
    {
        $limit = config("plans.{$this->user->plan}.{$limitKey}", 0);

        return $current > $limit;
    }

    public function textOnPrimary(): string
    {
        $hex = ltrim($this->config['colors']['primary'] ?? '#2d2d2d', '#');
        [$r, $g, $b] = array_map(
            fn($c) => hexdec($c) / 255,
            str_split($hex, 2)
        );
        // Luminancia relativa WCAG 2.1
        $luminance = 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;

        return $luminance > 0.4 ? '#1a1a1a' : '#ffffff';
    }

    public function secondaryColor(): string
    {
        if (! empty($this->config['colors']['secondary'])) {
            return $this->config['colors']['secondary'];
        }
        $primary = $this->config['colors']['primary'] ?? '#2d2d2d';
        $r = (int)(hexdec(substr($primary, 1, 2)) * 0.2 + 0x1a * 0.8);
        $g = (int)(hexdec(substr($primary, 3, 2)) * 0.2 + 0x1a * 0.8);
        $b = (int)(hexdec(substr($primary, 5, 2)) * 0.2 + 0x1a * 0.8);
        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }
}
