<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
use Session;

class Locale {
    public function handle($request, Closure $next) {
        $raw_locale = Session::get('locale');

        if (in_array($raw_locale, Config::get('app.locales'))) {
            $locale = $raw_locale;
        } else {
            $locale = Config::get('app.locale');
        }

        App::setLocale($locale);
        return $next($request);
    }
}
