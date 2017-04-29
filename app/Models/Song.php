<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'songs';

    public function getActiveAttribute($value)
    {
        return $value ? true : false;
    }

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = $value ? 1 : 0;
    }

    public static function getAll()
    {
        return self::orderBy('rating', 'asc')->get();
    }
}
