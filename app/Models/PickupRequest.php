<?php

namespace App\Models;
use App\Model\TimeSlot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    use HasFactory;
    protected $table="pickup_requests";
    public function timeSlot()
    {
        return $this->hasOne(TimeSlot::class);
    }
}
