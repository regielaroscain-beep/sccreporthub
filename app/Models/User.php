<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // ─── Specialization → Issue Category mapping ──────────────────────────────

    const SPECIALIZATIONS = [
        'electrician'      => 'Electrician',
        'plumber'          => 'Plumber',
        'carpenter'        => 'Carpenter',
        'hvac_technician'  => 'HVAC Technician',
        'janitor'          => 'Janitor',
        'it_technician'    => 'IT Technician',
        'general'          => 'General (All)',
    ];

    const SPECIALIZATION_CATEGORIES = [
        'electrician'      => ['electrical'],
        'plumber'          => ['plumbing'],
        'carpenter'        => ['structural', 'furniture'],
        'hvac_technician'  => ['hvac'],
        'janitor'          => ['sanitation'],
        'it_technician'    => ['network'],
        'general'          => [], // empty = sees all
    ];

    /**
     * Returns the issue_category values this user's specialization covers.
     * Empty array means no filter (sees all).
     */
    public function getSpecializationCategoriesAttribute(): array
    {
        if (!$this->specialization) return [];
        return self::SPECIALIZATION_CATEGORIES[$this->specialization] ?? [];
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

    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class, 'maintenance_staff_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
