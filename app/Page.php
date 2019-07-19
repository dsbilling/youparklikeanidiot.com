<?php

namespace DPSEI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use \BinaryCabin\LaravelUUID\Traits\HasUUID, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    /**
     * A user that belong to the model.
     */
    public function author()
    {
        return $this->hasOne('DPSEI\User');
    }

    /**
     * A user that belong to the model.
     */
    public function editor()
    {
        return $this->hasOne('DPSEI\User');
    }
}
