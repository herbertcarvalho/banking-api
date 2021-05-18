<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Response;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
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

    public function test_getUsersAuthEmptyHeader(){
        $response = $this->get('api/getallusers');
        $response->assertStatus(401);
    }

    public function test_getTransferenciasAuthEmptyHeader(){
        $response = $this->get('api/transferencias');
        $response->assertStatus(401);
    }

    public function test_getContasporemailTransferenciasAuthEmptyHeader(){
        $response = $this->get('api/contasporemail');
        $response->assertStatus(401);
    }

    //public function test_Register(){

    //}

    public function test_getHistoricotransferencia(){
        $response = $this->get('api/gethistoricotransferencia');
        $response->assertStatus(404);
    }

    public function test_getInfoContaeagencia(){
        $response = $this->get('api/historicoporconta');
        $response->assertStatus(401);
    }
}
