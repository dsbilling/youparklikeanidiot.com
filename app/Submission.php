<?php

namespace DPSEI;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'longitude', 'latitude', 'description', 'licenceplate_id', 'user_id', 'parked_at',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user', 'licenseplate', 'images', 'types'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['parked_at'];

    /**
     * The user that belong to the model.
     */
    public function user()
    {
        return $this->belongsTo('DPSEI\User');
    }

    /**
     * The licenseplate that belong to the model.
     */
    public function licenseplate()
    {
        return $this->belongsTo('DPSEI\LicensePlate', 'licence_plate_id');
    }

    /**
     * The images that belong to the model.
     */
    public function images()
    {
        return $this->belongsToMany('DPSEI\Image');
    }

    /**
     * The types that belong to the model.
     */
    public function types()
    {
        return $this->belongsToMany('DPSEI\Type');
    }

}
