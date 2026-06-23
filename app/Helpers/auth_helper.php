<?php

if (! function_exists('isLoggedIn')) {
    function isLoggedIn(): bool
    {
        return service('session')->get('isLoggedIn') === true;
    }
}

if (! function_exists('currentUser')) {
    function currentUser()
    {
        return service('session')->get('user');
    }
}

if (! function_exists('userHasRole')) {
    function userHasRole($role): bool
    {
        $user = currentUser();
        if ($user === null) {
            return false;
        }

        $userRole = is_object($user) ? ($user->idrol ?? null) : ($user['idrol'] ?? null);
        return $userRole == $role;
    }
}

if (! function_exists('userHasPermission')) {
    function userHasPermission(string $permission): bool
    {
        $user = currentUser();
        if ($user === null) {
            return false;
        }

        $roleId = is_object($user) ? ($user->idrol ?? null) : ($user['idrol'] ?? null);

        // admin shortcut
        if ($roleId === 1 || $roleId === '1') {
            return true;
        }

        $aclConfig = new \Config\Acl();
        $rolePerms = $aclConfig->rolePermissions[$roleId] ?? [];

        if (in_array('*', $rolePerms, true)) {
            return true;
        }

        return in_array($permission, $rolePerms, true);
    }
}
