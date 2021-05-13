<?php

namespace App\Http\Controllers;

use App\Http\Requests\infoUserRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class tableinfoController extends Controller
{
    public function registrarUsuarioTableInfo(infoUserRequest $request){

        $input = $request->Validated();

    }
}
