<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180316140521 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        //$this->addSql('DROP SEQUENCE sub_producto_id_seq CASCADE');
        $this->addSql('CREATE TABLE menus_roles (id_menu INT NOT NULL, id_role INT NOT NULL, PRIMARY KEY(id_menu, id_role))');
        $this->addSql('CREATE INDEX IDX_E75CC96BF6252691 ON menus_roles (id_menu)');
        $this->addSql('CREATE INDEX IDX_E75CC96BDC499668 ON menus_roles (id_role)');
        $this->addSql('ALTER TABLE menus_roles ADD CONSTRAINT FK_E75CC96BF6252691 FOREIGN KEY (id_menu) REFERENCES menu (id_menu) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menus_roles ADD CONSTRAINT FK_E75CC96BDC499668 FOREIGN KEY (id_role) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        //$this->addSql('DROP INDEX uniq_a7bb061520332d99');
        //$this->addSql('ALTER TABLE producto DROP codigo');
        //$this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT CURRENT_TIMESTAMP');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE sub_producto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE menus_roles');
        $this->addSql('ALTER TABLE producto ADD codigo VARCHAR(2) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_a7bb061520332d99 ON producto (codigo)');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
    }
}
