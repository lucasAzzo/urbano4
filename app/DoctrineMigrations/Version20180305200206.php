<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180305200206 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO modulo(
	id_modulo, nombre, orden)
	VALUES (1, 'MENÚ', 10);");
        
        $this->addSql("INSERT INTO submodulo(
	id_submodulo, id_modulo, nombre, orden, path, parametro)
	VALUES (1, 1, 'KNP menú', 10, 'menu_index', '');");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
