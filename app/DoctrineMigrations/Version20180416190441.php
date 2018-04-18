<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416190441 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE codigo_postal (id SERIAL NOT NULL, id_sucursal INT DEFAULT NULL, id_user INT DEFAULT NULL, id_estado INT DEFAULT NULL, codPostal INT NOT NULL, created DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CDF05B79B94781C3 ON codigo_postal (id_sucursal)');
        $this->addSql('CREATE INDEX IDX_CDF05B796B3CA4B ON codigo_postal (id_user)');
        $this->addSql('CREATE INDEX IDX_CDF05B796A540E ON codigo_postal (id_estado)');
        $this->addSql('ALTER TABLE codigo_postal ADD CONSTRAINT FK_CDF05B79B94781C3 FOREIGN KEY (id_sucursal) REFERENCES sucursal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE codigo_postal ADD CONSTRAINT FK_CDF05B796B3CA4B FOREIGN KEY (id_user) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE codigo_postal ADD CONSTRAINT FK_CDF05B796A540E FOREIGN KEY (id_estado) REFERENCES estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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
        $this->addSql('DROP TABLE codigo_postal');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
    }
}
