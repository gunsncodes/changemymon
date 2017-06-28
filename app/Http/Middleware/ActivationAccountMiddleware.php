<?php

namespace cambiomidinero\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Session;

class ActivationAccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
        
    public function handle($request, Closure $next)
    {
        $isError = null;
        $streamActivationLenght = env('STREAM_ACTIVATION_LENGTH');
        if((strlen($request->stream) == $streamActivationLenght) &&
            ($this->validateStream($request->stream))) {
            $request->attributes->add(['statusValidationParameters' => true]);
        }else{
            $request->attributes->add(['statusValidationParameters' => false]);
        }
        return $next($request);
    }

    private function validateStream($stream){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $status = 1;
        for ($a = 0; $a < strlen($stream); $a++) {
            if (strpos($characters, substr($stream, $a, 1)) === false) {
                $status = 0;
                break;
            }
        }
        return $status;
    }
}