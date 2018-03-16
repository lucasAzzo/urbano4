<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180307173410 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql("delete from operacion;");
        $this->addSql("delete from submodulo;");
        $this->addSql("delete from modulo;");
        
        $this->addSql('ALTER TABLE submodulo DROP CONSTRAINT fk_8a8d4713cac67adb');
        $this->addSql('ALTER TABLE operacion DROP CONSTRAINT fk_d44fc94bab8fb34');
        $this->addSql('DROP SEQUENCE modulo_id_modulo_seq CASCADE');
        $this->addSql('DROP SEQUENCE operacion_id_operacion_seq CASCADE');
        $this->addSql('DROP SEQUENCE submodulo_id_submodulo_seq CASCADE');
        $this->addSql('DROP TABLE operacion');
        $this->addSql('DROP TABLE modulo');
        $this->addSql('DROP TABLE submodulo');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE modulo_id_modulo_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE operacion_id_operacion_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE submodulo_id_submodulo_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE operacion (id_operacion INT NOT NULL, id_submodulo INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, orden INT NOT NULL, path VARCHAR(255) NOT NULL, parametro VARCHAR(255) NOT NULL, PRIMARY KEY(id_operacion))');
        $this->addSql('CREATE INDEX idx_d44fc94bab8fb34 ON operacion (id_submodulo)');
        $this->addSql('CREATE TABLE modulo (id_modulo INT NOT NULL, nombre VARCHAR(255) NOT NULL, orden INT NOT NULL, PRIMARY KEY(id_modulo))');
        $this->addSql('CREATE TABLE submodulo (id_submodulo INT NOT NULL, id_modulo INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, orden INT NOT NULL, path VARCHAR(255) NOT NULL, parametro VARCHAR(255) NOT NULL, PRIMARY KEY(id_submodulo))');
        $this->addSql('CREATE INDEX idx_8a8d4713cac67adb ON submodulo (id_modulo)');
        $this->addSql('ALTER TABLE operacion ADD CONSTRAINT fk_d44fc94bab8fb34 FOREIGN KEY (id_submodulo) REFERENCES submodulo (id_submodulo) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE submodulo ADD CONSTRAINT fk_8a8d4713cac67adb FOREIGN KEY (id_modulo) REFERENCES modulo (id_modulo) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}