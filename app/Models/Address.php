<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PickupRequest;

class Address extends Model
{
    use HasFactory;
    protected $table="addresses";
    protected $fillable = ["city", "street", "bldg", "floor"];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function request()
    {
        return $this->hasMany(PickupRequest::class);
    }
}
