<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class CountryHelper
{


    public static function validateCountryCode($countryCode)
    {
        try {
            $data = (new \League\ISO3166\ISO3166)->alpha2($countryCode);

            // If we get this far then we're good
            return true;
        } catch (\Exception $ex) {
            // was not a valid country code
        }

        return false;
    }
}
