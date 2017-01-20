<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
    ];
    protected $fillable = [
        'name', 'firstname', 'lastname', 'email', 'password', 'country', 'state', 'city', 'zipcode', 'address1', 'address2', 'profile_image', 'timezone', 'gender', 'usertype', 'remember_token', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() {
        return $this->admin; // this looks for an admin column in your users table
    }

   
}
