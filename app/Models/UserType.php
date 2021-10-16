<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserType extends Model
{
    use HasFactory;
    protected $table="user_types";
    public $timestamps = false;
    public function user()
    {
        return $this->hasMany(User::class, 'user_type');
    }
}
