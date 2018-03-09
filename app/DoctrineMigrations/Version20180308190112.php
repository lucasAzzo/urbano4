<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180308190112 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO categoria(
	id_categoria, categoria)
	VALUES (1, 'COLABORADORES');");
        
        $this->addSql("INSERT INTO categoria(
	id_categoria, categoria)
	VALUES (2, 'FLETEROS');");
        
        $this->addSql("INSERT INTO categoria(
	id_categoria, categoria)
	VALUES (3, 'EJECUTIVOS');");
        
        $this->addSql("INSERT INTO categoria(
	id_categoria, categoria)
	VALUES (4, 'CHOFERES');");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
