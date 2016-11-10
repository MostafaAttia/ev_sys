<?php

namespace App\Models;

use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Authenticatable
{

    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

    protected $primaryKey = 'id';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array $dates
     */
    public $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'gender',
        'dob',
        'phone',
        'address',
        'confirmation_code',
        'is_email_confirmed',
        'image_path'
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_code'
    ];

    /**
     * This mutator automatically hashes the password.
     *
     * @var string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

//    /**
//     * Boot all of the bootable traits on the model.
//     */
//    public static function boot()
//    {
//        parent::boot();
//
//        static::creating(function ($client) {
//            $client->confirmation_code = str_random();
////            $user->api_token = str_random(60);
//        });
//    }
}
