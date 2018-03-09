<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180307185102 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE ciudad_id_ciudad_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pais_id_pais_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE provincia_id_provincia_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE region_id_region_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sucursal_id_sucursal_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ciudad (id_ciudad INT NOT NULL, ciudad VARCHAR(255) NOT NULL, PRIMARY KEY(id_ciudad))');
        $this->addSql('CREATE TABLE pais (id_pais INT NOT NULL, pais VARCHAR(255) NOT NULL, PRIMARY KEY(id_pais))');
        $this->addSql('CREATE TABLE provincia (id_provincia INT NOT NULL, provincia VARCHAR(255) NOT NULL, PRIMARY KEY(id_provincia))');
        $this->addSql('CREATE TABLE region (id_region INT NOT NULL, region VARCHAR(255) NOT NULL, PRIMARY KEY(id_region))');
        $this->addSql('CREATE TABLE sucursal (id_sucursal INT NOT NULL, sucursal VARCHAR(255) NOT NULL, PRIMARY KEY(id_sucursal))');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ciudad_id_ciudad_seq CASCADE');
        $this->addSql('DROP SEQUENCE pais_id_pais_seq CASCADE');
        $this->addSql('DROP SEQUENCE provincia_id_provincia_seq CASCADE');
        $this->addSql('DROP SEQUENCE region_id_region_seq CASCADE');
        $this->addSql('DROP SEQUENCE sucursal_id_sucursal_seq CASCADE');
        $this->addSql('DROP TABLE ciudad');
        $this->addSql('DROP TABLE pais');
        $this->addSql('DROP TABLE provincia');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE sucursal');
    }
}
