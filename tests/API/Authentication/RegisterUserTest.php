<?php

namespace Tests\API\Authentication;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RegisterUserTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;
    /**
     * @inheritDoc
     */
    public function createApplication()
    {
        // TODO: Implement createApplication() method.
    }
}
