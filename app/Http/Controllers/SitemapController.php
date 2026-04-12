<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            [
                'loc' => url('/'),
                'priority' => '1.0',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => url('/services'),
                'priority' => '0.9',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => url('/design'),
                'priority' => '0.8',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => url('/packages'),
                'priority' => '0.9',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => url('/why-us'),
                'priority' => '0.7',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => url('/contact'),
                'priority' => '0.8',
                'changefreq' => 'weekly'
            ],
        ];
        
        $xml = view('sitemap', ['urls' => $urls])->render();
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}