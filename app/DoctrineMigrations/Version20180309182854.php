<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180309182854 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE legajo ADD id_estado INT DEFAULT NULL');
        $this->addSql('ALTER TABLE legajo DROP ref_estado');
        $this->addSql('ALTER TABLE legajo ADD CONSTRAINT FK_32DD07F66A540E FOREIGN KEY (id_estado) REFERENCES estado (id_estado) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_32DD07F66A540E ON legajo (id_estado)');
        $this->addSql('ALTER TABLE persona ADD id_estado INT DEFAULT NULL');
        $this->addSql('ALTER TABLE persona ADD CONSTRAINT FK_51E5B69B6A540E FOREIGN KEY (id_estado) REFERENCES estado (id_estado) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_51E5B69B6A540E ON persona (id_estado)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE legajo DROP CONSTRAINT FK_32DD07F66A540E');
        $this->addSql('DROP INDEX IDX_32DD07F66A540E');
        $this->addSql('ALTER TABLE legajo ADD ref_estado VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE legajo DROP id_estado');
        $this->addSql('ALTER TABLE persona DROP CONSTRAINT FK_51E5B69B6A540E');
        $this->addSql('DROP INDEX IDX_51E5B69B6A540E');
        $this->addSql('ALTER TABLE persona DROP id_estado');
    }
}
