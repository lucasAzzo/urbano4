<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180309182143 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO estado(
	id_estado, estado, abreviado)
	VALUES (1, 'ACTIVO', 'AC');");
        
        $this->addSql("INSERT INTO estado(
	id_estado, estado, abreviado)
	VALUES (2, 'INACTIVO', 'IN');");
        
        $this->addSql("INSERT INTO estado(
	id_estado, estado, abreviado)
	VALUES (3, 'ANULADO', 'AN');");
        
        $this->addSql("INSERT INTO estado(
	id_estado, estado, abreviado)
	VALUES (4, 'PROCESADO', 'PR');");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
