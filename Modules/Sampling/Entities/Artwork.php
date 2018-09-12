<?php

namespace Modules\Sampling\Entities;

use App\Filters\ArtworkFilter;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Artwork extends Model
{
    protected $fillable = ['reference_number', 'client_name', 'division', 'date', 'description', 'note'];

    /**
     * Set the artwork receive date.
     *
     * @param  string $value
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

    public function getDivisionAttribute($value)
    {
        switch ($value) {
            case 0:
                return ['name' => 'Men', 'value' => $value];
                break;
            case 1:
                return ['name' => 'Women', 'value' => $value];
                break;
            case 2:
                return ['name' => 'Children', 'value' => $value];
                break;
            default:
                echo "default";
        }
    }

    public function scopeFilter($query, ArtworkFilter $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Get all of the combos for the artwork.
     */
    public function combos()
    {
        return $this->hasManyThrough('Modules\Sampling\Entities\Combo', 'Modules\Sampling\Entities\Position');
    }
}
