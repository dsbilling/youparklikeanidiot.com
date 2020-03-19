<?php

namespace DPSEI;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'submission_id'
    ];

    /**
     * The submissions that belong to the model.
     */
    public function submissions()
    {
        return $this->hasOne('DPSEI\Submission');
    }
    
}
