<?php

namespace DPSEI;

use Illuminate\Database\Eloquent\Model;

class LicensePlate extends Model
{
    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registration',
    ];

    /**
     * The submissions that belong to the model.
     */
    public function submissions()
    {
        return $this->belongsToMany('DPSEI\Submission');
    }

}
