<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180312153306 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE shipper ADD id_estado INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipper DROP ref_estado');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFD6A540E FOREIGN KEY (id_estado) REFERENCES estado (id_estado) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A926CAFD6A540E ON shipper (id_estado)');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT CURRENT_TIMESTAMP');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE shipper DROP CONSTRAINT FK_A926CAFD6A540E');
        $this->addSql('DROP INDEX IDX_A926CAFD6A540E');
        $this->addSql('ALTER TABLE shipper ADD ref_estado VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE shipper DROP id_estado');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
    }
}
