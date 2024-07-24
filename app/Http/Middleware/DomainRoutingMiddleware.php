<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DomainRoutingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $domain = $request->route('domain');
        $tld = $request->route('tld');
        $subdomain = $request->route('subdomain');

        // Обработка поддоменов
        if ($subdomain) {
            // Выполнение действий для поддомена
            return $next($request);
        }

        // Обработка доменов первого уровня
        if ($domain && $tld) {
            // Выполнение действий для домена первого уровня
            return $next($request);
        }

        // Вернуть 404 или другой ответ, если не найден подходящий маршрут
        abort(404);
    }
}
