<?php

namespace App\Models;
use App\Model\PickupRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;
    protected $table="time_slots";
    public $timestamps = false;
    public function pickup()
    {
        return $this->belongsToMany(PickupRequest::class);
    }
}
