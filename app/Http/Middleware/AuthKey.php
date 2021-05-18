<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $url = $request->getRequestUri();
        $token = $request->header('Authorization');
        $cabecalhoHtppAccept = collect($request->header('accept'))->first();

        if($cabecalhoHtppAccept != "application/json"){
            return response() -> json(['message'=> 'verifique o cabecalho da sua requisicao http'],401);
        }

        $existeToken = User::with([])
            ->where(['remember_token' => $token])
            ->get();

        ($url == '/api/login' || $url == '/api/register') ? $boolean = false : $boolean = true;

        if(collect($existeToken)->isEmpty() && $boolean){
            return response() -> json(['message'=> 'key not found'],401);
        }

        if(collect($request->header('Authorization'))->isEmpty() && $boolean){
            return response() -> json(['message'=> 'Necessario ter um token para acessar essas funcionalidades'],401);
        }

        return $next($request);
    }
}
