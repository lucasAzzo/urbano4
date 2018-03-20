<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180320130004 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE param_id_param_seq CASCADE');
        $this->addSql('DROP TABLE param');
        $this->addSql('ALTER TABLE route ADD parametro VARCHAR(10) DEFAULT NULL');
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
        $this->addSql('CREATE SEQUENCE param_id_param_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE param (id_param INT NOT NULL, id_route INT DEFAULT NULL, id_menu INT DEFAULT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id_param))');
        $this->addSql('CREATE INDEX idx_a4fa7c89ec416149 ON param (id_route)');
        $this->addSql('CREATE INDEX idx_a4fa7c89f6252691 ON param (id_menu)');
        $this->addSql('ALTER TABLE param ADD CONSTRAINT fk_a4fa7c89ec416149 FOREIGN KEY (id_route) REFERENCES route (id_route) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE param ADD CONSTRAINT fk_a4fa7c89f6252691 FOREIGN KEY (id_menu) REFERENCES menu (id_menu) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE route DROP parametro');
    }
}
