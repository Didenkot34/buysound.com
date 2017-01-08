<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';

    public function getActiveAttribute($value)
    {
        return $value ? true : false;
    }

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = $value ? 1 : 0;
    }
}
