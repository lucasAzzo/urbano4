<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180323121107 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO route(
	id_route, path, name, parametro)
	VALUES (49, '/menus', 'menu_index', null);");
        
        $this->addSql("INSERT INTO menu(
	id_menu, id_menu_padre, nombre, orden, icono, id_route)
	VALUES (13, null, 'CONFIGURACIÓN', 20, 'dashboard', null);");
        
        $this->addSql("INSERT INTO menu(
	id_menu, id_menu_padre, nombre, orden, icono, id_route)
	VALUES (14, 13, 'MENÚ', 10, null, 49);");
        
        $this->addSql("INSERT INTO routes_roles(
	id_route, id_role)
	VALUES (49, 2);");
        
        $this->addSql("SELECT setval('menu_id_menu_seq', 15, true);");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
