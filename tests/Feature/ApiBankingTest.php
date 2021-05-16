<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Response;
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

        $response->assertStatus(200);
    }

    public function test_getallusersEmpty(){
        $response = $this->get('api/getallusers');
        $response->assertStatus(200);
    }

    public function test_getallusers(){
        $numeroajudatest =random_int(1,999999);
        User::create([
            'email' => $numeroajudatest,
            'password' => '123',
            'name' =>'test'
        ]);
        $response = $this->get('api/getallusers');
        $response->assertStatus(200);
    }

    public function test_getalltransferencias(){
        $numeroajudatest =random_int(1,999999);
        User::create([
            'email' => $numeroajudatest,
            'password' => '123',
            'name' =>'test'
        ]);
        $response = $this->get('api/getallusers');
        $response->assertStatus(200);
    }
}
