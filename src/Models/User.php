<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'town',
        'postcode',
        'country',
        'phone',
        'email',
        'empID',
        'password',
        'role',
        'organisation',
        'dob',
        'probation',
    ];
}
