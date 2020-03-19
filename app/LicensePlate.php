<?php

namespace DPSEI;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class LicensePlate extends Model implements Searchable
{
    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_code',
        'registration',
    ];

    /**
     * The submissions that belong to the model.
     */
    public function submissions()
    {
        return $this->hasMany('DPSEI\Submission');
    }

    /**
    * Make the model searchable
    **/
    public function getSearchResult(): SearchResult
    {
        $url = route('licenseplate.show', $this->registration);
     
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->registration,
            $url
         );
    }
}
