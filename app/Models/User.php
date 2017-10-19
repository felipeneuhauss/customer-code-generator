<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Traits\UuidModel;

class User extends Authenticatable
{
    use Notifiable, UuidModel;
    
    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider','provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
