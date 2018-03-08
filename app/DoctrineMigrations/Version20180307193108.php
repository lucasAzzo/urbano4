<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180307193108 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO menu(
	id_menu, id_menu_padre, nombre, orden, path, parametro)
	VALUES (1, null, 'ABM', 10, null, null);");
        
        $this->addSql("INSERT INTO menu(
	id_menu, id_menu_padre, nombre, orden, path, parametro)
	VALUES (2, 1, 'SHIPPERS', 10, 'shipper_index', null);");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
