<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'maintenance_staff_id',
        'action_taken',
        'repair_notes',
        'repair_cost',
        'materials_used',
        'status',
    ];

    protected $casts = [
        'repair_cost' => 'decimal:2',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function maintenanceStaff()
    {
        return $this->belongsTo(User::class, 'maintenance_staff_id');
    }
}
