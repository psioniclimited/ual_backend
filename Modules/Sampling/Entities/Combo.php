<?php

namespace Modules\Sampling\Entities;

use App\Filters\ComboFilter;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $fillable = ['name', 'color'];


    public function position()
    {
        return $this->belongsTo('Modules\Sampling\Entities\Position');
    }

    public function scopeFilter($query, ComboFilter $filters)
    {
        return $filters->apply($query);
    }

}
