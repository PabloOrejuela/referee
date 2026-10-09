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

        // Verificar si el usuario ha iniciado sesión.
        if (! $session->get('isLoggedIn')) {
            return redirect()->to(site_url('login'));
        }

        // Si la ruta no requiere permisos específicos,
        // basta con comprobar que el usuario esté autenticado.
        if (empty($arguments)) {
            return null;
        }

        // Obtener el rol del usuario desde la sesión.
        $user = $session->get('user');

        $roleId = is_object($user)
            ? ($user->idrol ?? null)
            : (is_array($user) ? ($user['idrol'] ?? null) : null);

        // Si no se pudo identificar el rol, denegar el acceso.
        if ($roleId === null) {
            return redirect()->to(site_url('/'))
                ->with('error', 'No tiene permiso para acceder a esta sección.');
        }

        // El administrador tiene acceso a todas las secciones.
        if ((int) $roleId === 1) {
            return null;
        }

        // Verificar los permisos del rol en la base de datos.
        $aclConfig = new \Config\Acl();

        foreach ($arguments as $required) {
            if ($aclConfig->hasPermission($roleId, $required)) {
                return null;
            }
        }

        // Denegar el acceso si no tiene ninguno de los permisos requeridos.
        return redirect()->to(site_url('/'))
            ->with('error', 'No tiene permiso para acceder a esta sección.');
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // No se requiere ninguna acción después de la solicitud.
    }
}
