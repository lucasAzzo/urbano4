<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180306141204 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE menu_id_menu_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE menu (id_menu INT NOT NULL, id_menu_padre INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, orden INT NOT NULL, path VARCHAR(255) DEFAULT NULL, parametro VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id_menu))');
        $this->addSql('CREATE INDEX IDX_7D053A93E743C95B ON menu (id_menu_padre)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93E743C95B FOREIGN KEY (id_menu_padre) REFERENCES menu (id_menu) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A93E743C95B');
        $this->addSql('DROP SEQUENCE menu_id_menu_seq CASCADE');
        $this->addSql('DROP TABLE menu');
    }
}
