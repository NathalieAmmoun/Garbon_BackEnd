<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business;
use App\Model\Collector;
class Industry extends Model
{
    use HasFactory;
    protected $table="industries";
    public $timestamps = false;

    public function business()
    {
        return $this->hasMany(Business::class);
    }
    public function collector()
    {
        return $this->belongsToMany(Collector::class);
    }
}
