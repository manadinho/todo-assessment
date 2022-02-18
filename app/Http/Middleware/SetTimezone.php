<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Ip;
use Illuminate\Support\Facades\Http;

class SetTimezone
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
        if(!request()->session()->has('timezone'))
        {
            $ipAddress = request()->ip();
            if(!Cache::has('ips')){
                $ips = Ip::all();
                Cache::put('ips', $ips);
            }
            $ip = cache('ips')->where('ip', $ipAddress)->first();
            if(empty($ip))
            {
                $ipDetail = HTTP::get("http://ip-api.com/json/$ipAddress")->object();
                if(strtolower($ipDetail->status) == 'success')
                {
                    /*
                    STORING IP DETAIL IN DB:
                       IN ORDER TO REDUCE CALLS TO THIRD PARTY API
                       IN ORDER TO COLLECT DATA AGAINST IP's WHICH CAN BE USED IN FUTURE
                    */
                    $ip = Ip::create(['ip' => $ipAddress, 'detail' => $ipDetail]);
                    $ips = Ip::all();
                    Cache::put('ips', $ips);
                }
            }
            $timezone = (!empty($ip->detail['timezone'])) ? $ip->detail['timezone'] : 'Asia/Karachi' ;
            session(['timezone' => $timezone]);
        }
        return $next($request);
    }
}
