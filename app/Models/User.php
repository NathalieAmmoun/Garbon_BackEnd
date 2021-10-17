<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject; 

use App\Models\Business;
use App\Models\Address;
use App\Models\Collector;
use App\Models\UserType;
use App\Models\PickupRequest;

class User extends Authenticatable implements JWTSubject 
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'first_name','last_name','user_type','phone','email','password', 'device_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  	public function address(){
          return $this.hasOne(Address::class);
      }
    public function business()
    {
        return $this->hasOne(Business::class);
    }
    public function collector()
    {
        return $this->hasOne(Collector::class);
    }  
    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }  
    public function request()
    {
        return $this->hasMany(PickUpRequest::class);
    }  


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}