<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180316150748 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (1, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (2, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (3, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (4, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (5, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (6, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (7, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (8, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (9, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (10, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (11, 2);");
        
        $this->addSql("INSERT INTO menus_roles(
	id_menu, id_role)
	VALUES (12, 2);");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
