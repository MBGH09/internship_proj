<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mb_Category extends Model
{
    protected $table = 'mb_categories';
    protected $primaryKey = 'mb_cat_id';
    protected $fillable = ['mb_cat_name', 'mb_cat_description'];
    public function events()
    {
        return $this->hasMany(mb_Event::class, 'mb_category_id', 'mb_cat_id');
    }
}
