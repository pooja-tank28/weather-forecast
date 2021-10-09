<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\City;

class WeatherControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test5DaysForeCaseByCity()
    {
        // For invalid city, should return 404
        $cityKey = 'iut488ndhf';
        $response = $this->json('get', 'api/v1/weather/' . $cityKey);
        $response->assertStatus(404);

        $city = City::factory()->create(['name' => 'London', 'country' => 'GB']);
        $response = $this->json('get', 'api/v1/weather/' . $city->key);
        $response->assertStatus(200);
    }
}
