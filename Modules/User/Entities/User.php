<?php

namespace Modules\User\Entities;

use App\Filters\UserFilter;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use EntrustUserTrait;
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
