<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_name',
        'room_number',
        'floor',
        'description',
    ];

    /**
     * Full location label.
     */
    public function getFullLocationAttribute(): string
    {
        $parts = array_filter([
            $this->building_name,
            $this->floor ? "Floor {$this->floor}" : null,
            $this->room_number ? "Room {$this->room_number}" : null,
        ]);
        return implode(', ', $parts);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'location_id');
    }
}
