<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            $agent = new Agent();
            $country='';
            $city='';
            $position = Location::get(request()->ip());
            if ($position) {
                $country = $position->countryName;
                $city = $position->cityName;
            }
            Visitor::create([
                'ip' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'browser' => $agent->browser(),
                'platform' => $agent->platform(),
                'device' => $agent->device(),
                'countryName' => $country,
                'cityName' => $city,
            ]);
        }
        return $next($request);
    }
}
