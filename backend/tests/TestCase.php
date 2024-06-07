<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    //
    public function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'referer' => 'localhost:5173',
            'accept' => 'application/json'
        ]);
    }
}
