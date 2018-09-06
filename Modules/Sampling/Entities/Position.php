<?php

namespace Modules\Sampling\Entities;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['name'];

    public function artwork()
    {
        return $this->belongsTo('Modules\Sampling\Entities\Artwork');
    }

    public function combos()
    {
        return $this->hasMany('Modules\Sampling\Entities\Combo');
    }
}
