<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Laravel's HTTP test client strips the trailing slash from every URL,
     * but every page on the network lives at a slashed URL. Keep the URL
     * exactly as written in the test.
     */
    protected function prepareUrlForRequest($uri): string
    {
        if (str_starts_with($uri, '/')) {
            $uri = substr($uri, 1);
        }

        return url($uri);
    }
}
