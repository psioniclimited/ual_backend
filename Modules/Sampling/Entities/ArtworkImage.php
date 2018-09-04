<?php

namespace Modules\Sampling\Entities;

use Illuminate\Database\Eloquent\Model;

class ArtworkImage extends Model
{
    protected $fillable = ['filepath'];

    public function artwork()
    {
        return $this->belongsTo('Modules\Sampling\Entities\Artwork');
    }

}
