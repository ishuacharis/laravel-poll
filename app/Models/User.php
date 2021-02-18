<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\MailResetPasswordNotification;
use App\Notifications\VerificationEmailNotification;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'password',
        'remember_token'
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
     * The relationship between user and housemate
     * 
     * @param null
     * 
     * @return App\Models\Housemate|array
     */
    public function housemates() {
        return $this->belongsToMany('App\Models\Housemate')
        ->withPivot(['amount']);
    }


    /**
     * Send password reset notification
     *
     * @param string
     * 
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token,$this));
    }


    /**
     * Send email notification
     *
     *  
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $graceTimeInMinutes = 300;
        $expires  = time() + $graceTimeInMinutes;
        $this->notify(new VerificationEmailNotification($this,$expires));
    }
}
