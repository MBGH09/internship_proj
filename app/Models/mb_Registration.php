<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mb_Registration extends Model
{
    protected $table = 'mb_registrations';
    protected $primaryKey = 'mb_reg_id';
    protected $fillable = [
        'mb_event_id',
        'mb_user_id',
        'mb_registration_date',
        'mb_status',
    ];

    public function event()
    {
        return $this->belongsTo(mb_Event::class, 'mb_event_id');
    }

    public function user()
    {
        return $this->belongsTo(mb_User::class, 'mb_user_id');
    }
}
