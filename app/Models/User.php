<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
;

 class User extends Authenticatable implements JWTSubject
{




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'social_type',
        'social_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
     public function token()
     {
         return $this->hasOne(Token::class,'user_id');
     }

     // JWTSubject methods
     public function getJWTIdentifier()
     {
         return $this->getKey();
     }

     public function getJWTCustomClaims()
     {
         return [];
     }
 }
