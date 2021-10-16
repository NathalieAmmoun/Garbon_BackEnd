<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Collector;
class Recyclable extends Model
{
    use HasFactory;
    protected $table="recyclables";
    public $timestamps = false;
    public function collector()
    {
        return $this->belongsToMany(Collector::class);
    }
}
