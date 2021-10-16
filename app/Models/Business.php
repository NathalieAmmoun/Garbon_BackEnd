<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Industry;

class Business extends Model
{
    use HasFactory;
    protected $table="Businesses";
    protected $fillable = ["name"];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
