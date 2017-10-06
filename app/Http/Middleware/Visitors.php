<?php

namespace App\Http\Middleware;


use Request;
use Closure;
use App\Visitor;
use App\Country;
use Carbon\Carbon;
use App\VisitorCountry;


class Visitors
{

    public function handle($request, Closure $next)
    {
        $ip = (Request::ip() != '127.0.0.1') ? Request::ip() : null;
        $ip = '203.189.141.193';
        if($ip != null) {
            $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));

            if($query && $query['status'] == 'success') {
                $visitor = Visitor::where('ip', $ip)->first();
                if(!$visitor || $visitor->updated_at <= Carbon::now()->subDays(1)) {

                    $otherInfo = '';
                    foreach($query as $key => $value) {
                        $otherInfo .= $key . ' - ' . $value . "\n";
                    }

                    if(!$visitor) {
                        $visitor = new Visitor;
                        $visitor->ip = $ip;
                        $visitor->other_info = $otherInfo;
                        $visitor->save();                        

                    } else {
                        $visitor->updated_at = Carbon::now();
                        $visitor->save();
                    }

                    $visitorCountry = VisitorCountry::where('code', $query['countryCode'])->first();

                    if(!$visitorCountry) {

                        $country = Country::where('code', strtolower($query['countryCode']))->first();

                        $countryName = ($country) ? $country->name : $query['country'];

                        $visitorCountry = new VisitorCountry;
                        $visitorCountry->name = $countryName;
                        $visitorCountry->code = strtolower($query['countryCode']);
                        $visitorCountry->times_visited = 1;

                    } else {
                        $visitorCountry->times_visited = $visitorCountry->times_visited + 1;
                    }

                    $visitorCountry->save();                
                }
            }            
        }



        

        return $next($request);
    }
}
