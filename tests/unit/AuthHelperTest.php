<?php

use PHPUnit\Framework\TestCase;

class AuthHelperTest extends TestCase
{
    protected function setUp(): void
    {
        // Ensure session is started
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        // Clear session
        $_SESSION = [];
    }

    public function testUserHasPermissionForRole()
    {
        // role 2 has permission 'equipo' per Config\Acl
        $_SESSION['user'] = ['id' => 10, 'idrol' => 2, 'nombre' => 'Test'];

        // reload helper functions
        helper('auth');

        $this->assertTrue(userHasPermission('equipo'));
        $this->assertFalse(userHasPermission('informes'));
    }

    public function testAdminAlwaysHasPermission()
    {
        $_SESSION['user'] = ['id' => 1, 'idrol' => 1, 'nombre' => 'Admin'];
        helper('auth');

        $this->assertTrue(userHasPermission('anything'));
    }
}
