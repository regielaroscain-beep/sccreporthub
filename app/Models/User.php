<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    // ─── Specialization → Issue Category mapping ──────────────────────────────

    const SPECIALIZATIONS = [
        'electrician' => 'Electrician',
        'plumber'     => 'Plumber',
        'carpenter'   => 'Carpenter',
        'mason'       => 'Mason',
        'welder'      => 'Welder',
    ];

    const SPECIALIZATION_CATEGORIES = [
        'electrician' => ['electrical'],
        'plumber'     => ['plumbing'],
        'carpenter'   => ['carpentry'],
        'mason'       => ['masonry'],
        'welder'      => ['welding'],
    ];

    /**
     * Returns merged issue_category values from all specializations.
     * Supports multiple specializations stored as JSON array.
     * Empty array means no filter (sees all tickets).
     */
    public function getSpecializationCategoriesAttribute(): array
    {
        $specs = $this->specialization;
        if (empty($specs)) return [];

        // Support both old string and new array format
        if (is_string($specs)) {
            $specs = [$specs];
        }

        $categories = [];
        foreach ($specs as $spec) {
            $cats = self::SPECIALIZATION_CATEGORIES[$spec] ?? [];
            $categories = array_unique(array_merge($categories, $cats));
        }

        return $categories;
    }

    /**
     * Returns human-readable labels for all specializations.
     */
    public function getSpecializationLabelsAttribute(): string
    {
        $specs = $this->specialization;
        if (empty($specs)) return 'None';

        if (is_string($specs)) {
            $specs = [$specs];
        }

        $labels = array_map(fn($s) => self::SPECIALIZATIONS[$s] ?? $s, $specs);
        return implode(', ', $labels);
    }

    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'department',
        'specialization',
        'contact_number',
        'profile_photo',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'specialization'    => 'array',
    ];

    // ─── Accessors ────────────────────────────────────────────────────────────

    /**
     * Full name accessor.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Profile photo URL accessor.
     * Falls back to default-avatar.png when no photo is set.
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if (!empty($this->profile_photo)) {
            // Cloudinary returns full URL, local storage needs asset()
            if (str_starts_with($this->profile_photo, 'http')) {
                return $this->profile_photo;
            }
            return asset('storage/' . $this->profile_photo);
        }
        return asset('images/default-avatar.png');
    }

    // ─── Role Helpers ─────────────────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role && $this->role->slug === 'admin';
    }

    public function isFaculty(): bool
    {
        return $this->role && $this->role->slug === 'faculty';
    }

    public function isMaintenance(): bool
    {
        return $this->role && $this->role->slug === 'maintenance';
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
