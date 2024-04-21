<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $guarded = [];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }
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
    public function codeRecords()
    {
        return $this->hasMany(Coderecord::class);
    }
    public function simCards()
    {
        return $this->hasMany(Simcard::class);
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    public function activationsim()
    {
        return $this->hasMany(Activationsim::class);
    }
    public function activationSims()
    {
        return $this->hasMany(Activationsim::class);
    }
    public function internationalSims()
    {
        return $this->hasMany(Internationalsim::class);
    }
    public function markNotificationAsRead($notificationId)
    {
        $notification = $this->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }
    }
    // في نموذج المستخدم User.php
    public function soldLines()
    {
        return $this->hasMany(Soldline::class);
    }
    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }







}
