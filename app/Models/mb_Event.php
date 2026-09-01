<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mb_Event extends Model
{
    protected $table = 'mb_events';
    protected $primaryKey = 'mb_event_id';
    protected $fillable = [
        'mb_title',
        'mb_description',
        'mb_category_id',
        'mb_start_date',
        'mb_end_date',
        'mb_place',
        'mb_price',
        'mb_is_free',
        'mb_capacity',
        'mb_image',
        'mb_created_by',
        'mb_is_active',
    ];

    protected $casts = [
        'mb_start_date' => 'datetime',
        'mb_end_date' => 'datetime',
        'mb_is_free' => 'boolean',
        'mb_is_active' => 'boolean',
        'mb_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(mb_Category::class, 'mb_category_id', 'mb_cat_id');
    }
    public function creator()
    {
        return $this->belongsTo(mb_User::class, 'mb_created_by');
    }
    public function registrations()
    {
        return $this->hasMany(mb_Registration::class, 'mb_event_id');
    }
    public function attendees()
    {
        return $this->belongsToMany(mb_User::class, 'mb_registrations', 'mb_event_id', 'mb_user_id');
    }
    public function getRemainingCapacity()
    {
        $registeredCount = $this->registrations()->count();
        return $this->mb_capacity - $registeredCount;
    }
    public function hasAvailableSpots()
    {
        return $this->getRemainingCapacity() > 0;
    }
    public function isUserRegistered($userId)
    {
        return $this->registrations()->where('mb_user_id', $userId)->exists();
    }
    public function getFormattedStartDateAttribute()
    {
        return $this->mb_start_date->format('d/m/Y H:i');
    }
    public function getFormattedEndDateAttribute()
    {
        return $this->mb_end_date->format('d/m/Y H:i');
    }

}
