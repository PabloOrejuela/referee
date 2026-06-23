<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Acl extends BaseConfig
{
    /**
     * Map role id => permissions (slugs)
     * Adjust these values to match your application's roles.
     */
    public array $rolePermissions = [
        // role 1 = admin (all permissions)
        1 => ['*'],
        // example mappings - adapt to your role ids
        2 => ['equipo'],
        3 => ['informes'],
        4 => ['arbitraje'],
        5 => [],
        6 => [],
    ];
}
