<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180308134741 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE subzona_id_subzona_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE zona_id_zona_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE subzona (id_subzona INT NOT NULL, id_zona INT DEFAULT NULL, subzona VARCHAR(255) NOT NULL, PRIMARY KEY(id_subzona))');
        $this->addSql('CREATE INDEX IDX_7E3376952CA6181C ON subzona (id_zona)');
        $this->addSql('CREATE TABLE zona (id_zona INT NOT NULL, zona VARCHAR(255) NOT NULL, PRIMARY KEY(id_zona))');
        $this->addSql('ALTER TABLE subzona ADD CONSTRAINT FK_7E3376952CA6181C FOREIGN KEY (id_zona) REFERENCES zona (id_zona) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sucursal ADD id_zona INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sucursal ADD CONSTRAINT FK_E99C6D562CA6181C FOREIGN KEY (id_zona) REFERENCES zona (id_zona) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E99C6D562CA6181C ON sucursal (id_zona)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE subzona DROP CONSTRAINT FK_7E3376952CA6181C');
        $this->addSql('ALTER TABLE sucursal DROP CONSTRAINT FK_E99C6D562CA6181C');
        $this->addSql('DROP SEQUENCE subzona_id_subzona_seq CASCADE');
        $this->addSql('DROP SEQUENCE zona_id_zona_seq CASCADE');
        $this->addSql('DROP TABLE subzona');
        $this->addSql('DROP TABLE zona');
        $this->addSql('DROP INDEX IDX_E99C6D562CA6181C');
        $this->addSql('ALTER TABLE sucursal DROP id_zona');
    }
}
