<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319155743 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE param ADD id_menu INT DEFAULT NULL');
        $this->addSql('ALTER TABLE param ADD CONSTRAINT FK_A4FA7C89F6252691 FOREIGN KEY (id_menu) REFERENCES menu (id_menu) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A4FA7C89F6252691 ON param (id_menu)');
        //$this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT CURRENT_TIMESTAMP');
        
        $this->addSql("update param set value=1, id_menu=6 where id_param=1;");
        $this->addSql("INSERT INTO param(id_param, id_route, name, value,id_menu) VALUES (2, 7, 'categoria', '2',7);");
        $this->addSql("INSERT INTO param(id_param, id_route, name, value,id_menu) VALUES (3, 7, 'categoria', '3',8);");
        $this->addSql("INSERT INTO param(id_param, id_route, name, value,id_menu) VALUES (4, 7, 'categoria', '4',9);");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE param DROP CONSTRAINT FK_A4FA7C89F6252691');
        $this->addSql('DROP INDEX IDX_A4FA7C89F6252691');
        $this->addSql('ALTER TABLE param DROP id_menu');
    }
}
