<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'user_id',
        'category_id',
        'location_id',
        'title',
        'description',
        'priority_level',
        'photo_path',
        'status',
        'assigned_to',
        'approved_by',
        'approved_at',
        'completed_at',
    ];

    protected $casts = [
        'approved_at'  => 'datetime',
        'completed_at' => 'datetime',
    ];

    // ─── Status Constants ─────────────────────────────────────────────────────

    const STATUS_PENDING  = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_ASSIGNED = 'assigned';
    const STATUS_ONGOING  = 'ongoing';
    const STATUS_RESOLVED = 'resolved';
    const STATUS_COMPLETED = 'completed';

    const PRIORITY_URGENT = 'urgent';
    const PRIORITY_HIGH   = 'high';
    const PRIORITY_NORMAL = 'normal';

    // ─── Accessors ────────────────────────────────────────────────────────────

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending'   => 'warning',
            'approved'  => 'info',
            'rejected'  => 'danger',
            'assigned'  => 'primary',
            'ongoing'   => 'secondary',
            'resolved'  => 'success',
            'completed' => 'dark',
            default     => 'light',
        };
    }

    public function getPriorityBadgeAttribute(): string
    {
        return match ($this->priority_level) {
            'urgent' => 'danger',
            'high'   => 'warning',
            'normal' => 'success',
            default  => 'secondary',
        };
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if ($this->photo_path) {
            return asset('storage/' . $this->photo_path);
        }
        return null;
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'location_id');
    }

    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    // ─── Scopes ───────────────────────────────────────────────────────────────

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeAssigned($query)
    {
        return $query->where('status', self::STATUS_ASSIGNED);
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', self::STATUS_ONGOING);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeUrgent($query)
    {
        return $query->where('priority_level', self::PRIORITY_URGENT);
    }
}
