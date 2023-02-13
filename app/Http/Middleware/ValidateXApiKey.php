<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateXApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-Api-Key');
        if ($apiKey !== env('API_KEY')) {
            return json_encode(['error' => 'Invalid API Key']);
        }

        return $next($request);
    }
}
