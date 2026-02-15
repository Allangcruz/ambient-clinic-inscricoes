<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InscricaoMigration extends Migration
{
    public function up()
    {
        $this->forge->addField("id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY");
        $this->forge->addField("nome VARCHAR(255) NOT NULL");
        $this->forge->addField("email VARCHAR(255) NOT NULL");
        $this->forge->addField("cpf VARCHAR(255) NOT NULL");
        $this->forge->addField("telefone VARCHAR(255)");
        $this->forge->addField("perfil VARCHAR(255) NOT NULL");
        $this->forge->addField("crmv VARCHAR(255)");
        $this->forge->addField("matricula VARCHAR(255)");
        $this->forge->addField("instituicao VARCHAR(255)");
        $this->forge->addField("pago VARCHAR(255) NOT NULL DEFAULT 'Não'");
        
        $this->forge->addField("created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->forge->addField("updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->forge->addField("deleted_at DATETIME");

        $this->forge->createTable('inscricoes', true);
    }

    public function down()
    {
        $this->forge->dropTable('inscricoes', true);
    }
}
