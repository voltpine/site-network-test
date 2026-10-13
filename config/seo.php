<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Search engine visibility
    |--------------------------------------------------------------------------
    |
    | When enabled every page gets a robots meta tag that asks crawlers not to
    | index it. Handy for staging copies of the network.
    |
    */

    'noindex' => (bool) env('SEO_NOINDEX', false),

    /*
    |--------------------------------------------------------------------------
    | Title suffix
    |--------------------------------------------------------------------------
    */

    'title_separator' => '｜',

];
