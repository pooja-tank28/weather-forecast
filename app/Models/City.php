<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'key';
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['key'] = Str::random(10);
    }

    public function getCity($data)
    {
        return $this->where([
            'name'=> Arr::get($data, 'name'),
            'country'=> Arr::get($data, 'country')
        ])->first();
    }
}
