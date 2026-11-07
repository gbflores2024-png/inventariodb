<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Evita que el sistema sea cargado dentro de iframes externos
        // Protección contra Clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Evita que el navegador interprete un archivo como otro tipo
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Controla la información enviada mediante Referer
        $response->headers->set(
            'Referrer-Policy',
            'strict-origin-when-cross-origin'
        );

        // Limita funciones sensibles del navegador
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=()'
        );

        return $response;
    }
}