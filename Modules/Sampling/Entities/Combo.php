<?php

namespace Modules\Sampling\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Filters\ArtworkFilter;

class Combo extends Model
{
    protected $fillable = ['name', 'color'];


    public function position()
    {
        return $this->belongsTo('Modules\Sampling\Entities\Position');
    }

    public function scopeFilter(ArtworkFilter $filters)
    {
        $query = DB::table('combos')
            ->join('positions','combos.position_id','=','positions.id')
            ->join('artworks','positions.artwork_id','=','artworks.id');
        return $filters->apply($query);
    }

}
