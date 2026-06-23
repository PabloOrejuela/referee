<?php

use PHPUnit\Framework\TestCase;
use Config\Routes;

class AuthFilterTest extends TestCase
{
    protected function setUp(): void
    {
        // Start a session for filter to read
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION = [];
    }

    public function testRedirectsWhenNotLoggedIn()
    {
        // Simulate request to protected route
        $_SESSION['isLoggedIn'] = false;

        // Instantiate filter
        $filter = new \App\Filters\AuthFilter();

        $request = \Config\Services::request();
        $response = \Config\Services::response();

        $result = $filter->before($request, ['params' => ['equipo']]);

        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $result);
    }
}
