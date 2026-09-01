<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class mb_User extends Authenticatable
{
    use Notifiable;
    protected $table = 'mb_users';
    protected $primaryKey = 'mb_id';
    protected $fillable = ['mb_name','mb_email','mb_phone','mb_password','mb_role',];
    protected $keyType = 'int';
    public $incrementing = true;
    protected $hidden = ['mb_password',];

    public function getAuthPassword()
    {
        return $this->mb_password;
    }
    public function eventAttending()
    {
        return $this->belongsToMany(mb_Event::class, 'mb_registrations', 'mb_user_id', 'mb_event_id');
    }
    
    public function events()
    {
        return $this->hasMany(mb_Event::class, 'mb_created_by');
    }
    public function registrations()
    {
        return $this->hasMany(mb_Registration::class, 'mb_user_id');
    }
    public function isAdmin()
    {
        return $this->mb_role === 'admin';
    }
    public function isUser()
    {
        return $this->mb_role === 'user';
    }
    public function countRegistrations()
    {
        return $this->registrations()->count();
    }


}
