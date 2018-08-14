<?php

namespace Modules\User\Entities;

use App\Filters\UserFilter;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [];
    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder    $query
     * @param  UserFilter $filters
     * @return Builder
     */
    public function scopeFilter($query, UserFilter $filters)
    {
        return $filters->apply($query);
    }
}
