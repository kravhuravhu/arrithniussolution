<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            [
                'loc' => secure_url('/'),
                'priority' => '1.0',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => secure_url('/services'),
                'priority' => '0.9',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => secure_url('/design'),
                'priority' => '0.8',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => secure_url('/packages'),
                'priority' => '0.9',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => secure_url('/why-us'),
                'priority' => '0.7',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => secure_url('/contact'),
                'priority' => '0.8',
                'changefreq' => 'weekly'
            ],
        ];
        
        $xml = view('sitemap', ['urls' => $urls])->render();
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}