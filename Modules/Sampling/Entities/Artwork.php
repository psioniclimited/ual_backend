<?php

namespace Modules\Sampling\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Artwork extends Model
{
    protected $fillable = ['reference_number', 'client_name', 'division', 'date', 'description', 'note'];
    /**
     * Set the artwork receive date.
     *
     * @param  string  $value
     * @return void
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function positions()
    {
        return $this->hasMany('Modules\Sampling\Entities\Position');
    }

    public function artwork_images()
    {
        return $this->hasMany('Modules\Sampling\Entities\ArtworkImage');
    }
}
