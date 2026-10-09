<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Config\Database;

class Acl extends BaseConfig {

    public function hasPermission($roleId, string $permission): bool { 
        // Evita consultar columnas que no sean permisos válidos. 
        $permissions = [ 'backend', 'informes', 'liga', 'equipo', 'jugador', 'arbitraje']; 

        if (! in_array($permission, $permissions, true)) { 
            return false; 
        }

        $db = Database::connect(); 
        $role = $db->table('roles') 
            ->select($permission)
            ->where('id', $roleId)
            ->get()
            ->getRowArray(); 

        return $role !== null && (int) $role[$permission] === 1; 
    }

}
