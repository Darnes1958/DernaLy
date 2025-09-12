<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use GPBMetadata\Google\Api\Log;
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
            $visitor= Visitor::where('ip', request()->ip())->orderByDesc('created_at')->first() ;
            if ($visitor){
                $from = now();
                $to = $visitor->created_at;
                $diffInMinutes = $to->diffInMinutes($from);
                if ($diffInMinutes>60)
                    Visitor::create([
                        'ip' => request()->ip(),
                        'user_agent' => request()->header('User-Agent'),
                        'browser' => $agent->browser(),
                        'platform' => $agent->platform(),
                        'device' => $agent->device(),
                        'countryName' => $country,
                        'cityName' => $city,
                    ]);
            } else
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
