<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180417121111 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO menu(
	id, id_menu_padre, id_route, nombre, orden, icono)
	VALUES (16, null, null, 'SUBIDA DE BASE', 30, 'dashboard');");
        
        $this->addSql("INSERT INTO menu(
	id, id_menu_padre, id_route, nombre, orden, icono)
	VALUES (17, 16, null, 'SUBIR ARCHIVOS', 10, null);");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
