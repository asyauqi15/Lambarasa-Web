<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'nick_name',
        'phone',
        'city_id',
        'school_id',
        'grade'
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function city()
    {
        return $this->belongsTo(City::class)->first();
    }

    public function school()
    {
        return $this->belongsTo(School::class)->first();
    }

    public function userQuestionPackets()
    {
        return $this->hasMany(UserQuestionPacket::class);
    }

    public function userQuestionPacketAnswers()
    {
        return $this->hasMany(UserQuestionPacketAnswer::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class)->first();
    }

    public function profile_photo()
    {
        if($this->profile_photo_path) return $this->profile_photo_path;

        $avatar = 'https://ui-avatars.com/api/?name='.str_replace(' ', '+', $this->name);
        return $avatar;
    }
}
