<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // insert pegawai
        for ($i = 0; $i < 10; $i++) {
            $data = [
                'nama' => static::faker()->name(),
                'email' => static::faker()->email(),
            ];
            $this->db->table('pegawai')->insert($data);
        }

        // insert otentikasi
        for ($i = 0; $i < 3; $i++) {
            $data = [
                'email' => static::faker()->email(),
                'password' => md5('12345'),
            ];
            $this->db->table('otentikasi')->insert($data);
        }
    }
}
