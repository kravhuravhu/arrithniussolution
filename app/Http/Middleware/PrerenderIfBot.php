<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PrerenderIfBot
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->userAgent();
        
        $bots = [
            'Googlebot', 'Bingbot', 'Slurp', 'DuckDuckBot',
            'Baiduspider', 'YandexBot', 'facebookexternalhit',
            'Twitterbot', 'LinkedInBot', 'WhatsApp', 'Pinterest',
            'Applebot', 'AhrefsBot', 'SemrushBot', 'MJ12bot'
        ];
        
        $isBot = false;
        foreach ($bots as $bot) {
            if (stripos($userAgent, $bot) !== false) {
                $isBot = true;
                break;
            }
        }

        if ($request->query('_escaped_fragment_') !== null) {
            $isBot = true;
        }

        if ($isBot && !$request->is('privacy', 'sitemap.xml', 'contact/send', 'quote/request')) {
            return $this->getPrerenderedPage($request);
        }
        
        return $next($request);
    }
    
    /**
     * Get prerendered page for bots
     */
    private function getPrerenderedPage(Request $request): Response
    {
        $path = $request->path();
        if ($path === '/') {
            $path = 'home';
        }
        
        $sectionMap = [
            '/' => 'home',
            'services' => 'all-services',
            'design' => 'design-services',
            'packages' => 'packages',
            'why-us' => 'why-choose-us',
            'contact' => 'contact',
        ];
        
        $section = $sectionMap[$request->path()] ?? 'home';

        $cacheKey = 'prerender_' . md5($section);
        
        $html = Cache::remember($cacheKey, 86400, function () use ($section) {
            return view('home', ['activeSection' => $section])->render();
        });
        
        return response($html)->header('X-Robots-Tag', 'index, follow');
    }
}