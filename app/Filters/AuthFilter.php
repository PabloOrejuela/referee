<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = service('session');

        if (! $session->get('isLoggedIn')) {
            return redirect()->to(site_url('login'));
        }
        // If route specifies permission arguments, validate against role permissions
        if ($arguments && is_array($arguments) && count($arguments) > 0) {
            $user = $session->get('user');
            $roleId = is_object($user) ? ($user->idrol ?? null) : ($user['idrol'] ?? null);

            // admin shortcut: role id 1 allowed to everything
            if ($roleId === 1 || $roleId === '1') {
                return null;
            }

            $aclConfig = new \Config\Acl();
            $rolePerms = $aclConfig->rolePermissions[$roleId] ?? [];

            foreach ($arguments as $required) {
                // allow wildcard permission
                if (in_array('*', $rolePerms, true)) {
                    return null;
                }

                if (in_array($required, $rolePerms, true)) {
                    return null; // has permission
                }
            }

            return redirect()->to(site_url('/'))->with('error', 'No tiene permiso para acceder a esta sección.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action required after the request.
    }
}
