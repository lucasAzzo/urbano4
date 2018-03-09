<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180309154534 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO menu(
	id_menu, id_menu_padre, nombre, orden, path, parametro)
	VALUES (6, 1, 'COLABORADORES', 50, 'persona_index', E'array(\"categoria\" => 1)');");
        
        $this->addSql("INSERT INTO menu(
	id_menu, id_menu_padre, nombre, orden, path, parametro)
	VALUES (7, 1, 'FLETEROS', 60, 'persona_index', E'array(\"categoria\" => 2)');");
        
        $this->addSql("INSERT INTO menu(
	id_menu, id_menu_padre, nombre, orden, path, parametro)
	VALUES (8, 1, 'EJECUTIVOS', 70, 'persona_index', E'array(\"categoria\" => 3)');");
        
        $this->addSql("INSERT INTO menu(
	id_menu, id_menu_padre, nombre, orden, path, parametro)
	VALUES (9, 1, 'CHOFERES', 80, 'persona_index', E'array(\"categoria\" => 4)');");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
