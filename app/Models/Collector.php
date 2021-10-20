<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Industry;
use App\Models\Recyclable;

class Collector extends Model
{
  
    use HasFactory;
    protected $table="collectors";
    protected $fillable = ["name", "description"];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function industry()
    {
        return $this->belongsToMany(Industry::class);
    }
    public function recyclable()
    {
        return $this->belongsToMany(Recyclable::class);
    }
}
