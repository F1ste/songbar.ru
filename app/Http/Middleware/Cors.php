<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Cors
{
    protected $domains = [
        'https://bot.site-for-test.ru',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // проверим, присутствует ли заголовок HTTP_ORIGIN в запросе
        // и разрешен ли домен
        $origin = 'https://bot.site-for-test.ru';
        if(!$origin || !in_array($origin, $this->domains, true)) {
            return new Response('Forbidden', 403);
        }
 
        //если есть, то устанавливаем нужные заголовки
        return $next($request)
            ->header('Access-Control-Allow-Origin', $origin)
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header(
                'Access-Control-Allow-Headers',
                'Authorization, Origin, X-Requested-With, Accept, X-PINGOTHER, Content-Type'
            );
    }
}
