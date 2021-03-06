<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;

class Client extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, SoftDeletes, CanFollow, CanLike, CanFavorite, Notifiable;

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
        'first_name',
        'last_name',
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

    /**
     * return path of client avatar, optionally select avatar size, default size is '60*60'
     * available sizes: 60 / 120 / 240 / original
     *
     * @param string $size
     * @return string
     */
    public function getAvatar($size = '60')
    {
        if($this->image_path) {
            switch ($size) {
                case 'original':
                    return config('attendize.s3_base_url').config('attendize.s3_client_original'). $this->image_path;
                    break;
                case '60':
                    return config('attendize.s3_base_url').config('attendize.s3_client_60_60'). $this->image_path;
                    break;
                case '120':
                    return config('attendize.s3_base_url').config('attendize.s3_client_120_120'). $this->image_path;
                    break;
                case '240':
                    return config('attendize.s3_base_url').config('attendize.s3_client_240_240'). $this->image_path;
                    break;
                default:
                    return config('attendize.s3_base_url').config('attendize.s3_client_60_60'). $this->image_path;
            }
        }

        return config('attendize.s3_base_url').config('attendize.s3_client_defaults'). 'original.jpg';

    }

    public function getPublicProfileURL()
    {
        return route('showPublicClientProfile', $this->id);
    }


    /**
     * The comments associated with the client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    /**
     * The ratings submitted by this client
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class);
    }

    /**
     * The preferences/settings of this client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meta()
    {
        return $this->hasOne(\App\Models\ClientMeta::class);
    }


}
