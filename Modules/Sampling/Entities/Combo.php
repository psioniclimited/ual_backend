<?php

namespace Modules\Sampling\Entities;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $fillable = ['name', 'color'];


    public function position()
    {
        return $this->belongsTo('Modules\Sampling\Entities\Position');
    }

}
