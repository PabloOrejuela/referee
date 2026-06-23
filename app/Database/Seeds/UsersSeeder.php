<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'nombre'      => 'Juan',
                'apellido'      => 'Pérez',
                'usuario'     => 'jperez',
                'password'    => password_hash('password123', PASSWORD_BCRYPT),
                'documento'   => '1234567890',
                'email'       => 'juan.perez@example.com',
                'telf_1'      => '3001234567',
                'telf_2'      => '3001234567',
                'direccion'   => 'Calle Principal 123, Apt 1',
                'imagen'      => 'avatar1.jpg',
                'fecha_nac'   => '1985-03-15',
                'idrol'       => 2,
                'estado'      => 1,
                'is_logged'   => 0,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'nombre'      => 'María',
                'apellido'    => 'López',
                'usuario'     => 'mlopez',
                'password'    => password_hash('password123', PASSWORD_BCRYPT),
                'documento'   => '2345678901',
                'email'       => 'maria.lopez@example.com',
                'telf_1'      => '3012345678',
                'telf_2'      => '3012345678',
                'direccion'   => 'Avenida Secundaria 45',
                'imagen'      => 'avatar2.jpg',
                'fecha_nac'   => '1990-07-22',
                'idrol'       => 3,
                'estado'      => 1,
                'is_logged'   => 0,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'nombre'      => 'Carlos',
                'apellido'    => 'Ramírez',
                'usuario'     => 'cramirez',
                'password'    => password_hash('password123', PASSWORD_BCRYPT),
                'documento'   => '3456789012',
                'email'       => 'carlos.ramirez@example.com',
                'telf_1'      => '3023456789',
                'telf_2'      => '3023456789',
                'direccion'   => 'Barrio Central 78',
                'imagen'      => 'avatar3.jpg',
                'fecha_nac'   => '1978-11-05',
                'idrol'       => 2,
                'estado'      => 1,
                'is_logged'   => 0,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'nombre'      => 'Ana',
                'apellido'    => 'González',
                'usuario'     => 'agonzalez',
                'password'    => password_hash('password123', PASSWORD_BCRYPT),
                'documento'   => '4567890123',
                'email'       => 'ana.gonzalez@example.com',
                'telf_1'      => '3034567890',
                'telf_2'      => '3034567890',
                'direccion'   => 'Calle del Sol 9',
                'imagen'      => 'avatar4.jpg',
                'fecha_nac'   => '1995-02-10',
                'idrol'       => 1,
                'estado'      => 1,
                'is_logged'   => 0,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'nombre'      => 'Pedro',
                'apellido'    => 'Martínez',
                'usuario'     => 'pmartinez',
                'password'    => password_hash('password123', PASSWORD_BCRYPT),
                'documento'   => '5678901234',
                'email'       => 'pedro.martinez@example.com',
                'telf_1'      => '3045678901',
                'telf_2'      => '3045678901',
                'direccion'   => 'Parque Norte 12',
                'imagen'      => 'avatar5.jpg',
                'fecha_nac'   => '1982-09-30',
                'idrol'       => 2,
                'estado'      => 1,
                'is_logged'   => 0,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        // Use Query Builder to insert data
        $this->db->table('users')->insertBatch($data);
    }
}
