<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
    public function test_es()
    {
        $response = $this->get('/es');

        $response->assertStatus(200);
    }
    public function test_en()
    {
        $response = $this->get('/en');

        $response->assertStatus(200);
    }
    public function test_admin()
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
    }
}
