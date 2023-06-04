<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pegawai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('pegawai');
    }

    public function down()
    {
        $this->forge->dropTable('pegawai');
    }
}
