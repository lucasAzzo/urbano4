<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319135517 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE param_id_param_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE route_id_route_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE param (id_param INT NOT NULL, id_route INT DEFAULT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id_param))');
        $this->addSql('CREATE INDEX IDX_A4FA7C89EC416149 ON param (id_route)');
        $this->addSql('CREATE TABLE route (id_route INT NOT NULL, path VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id_route))');
        $this->addSql('CREATE TABLE routes_roles (id_route INT NOT NULL, id_role INT NOT NULL, PRIMARY KEY(id_route, id_role))');
        $this->addSql('CREATE INDEX IDX_5E8606EEC416149 ON routes_roles (id_route)');
        $this->addSql('CREATE INDEX IDX_5E8606EDC499668 ON routes_roles (id_role)');
        $this->addSql('ALTER TABLE param ADD CONSTRAINT FK_A4FA7C89EC416149 FOREIGN KEY (id_route) REFERENCES route (id_route) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE routes_roles ADD CONSTRAINT FK_5E8606EEC416149 FOREIGN KEY (id_route) REFERENCES route (id_route) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE routes_roles ADD CONSTRAINT FK_5E8606EDC499668 FOREIGN KEY (id_role) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE menus_roles');
        $this->addSql('ALTER TABLE menu ADD id_route INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu DROP path');
        $this->addSql('ALTER TABLE menu DROP parametro');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93EC416149 FOREIGN KEY (id_route) REFERENCES route (id_route) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7D053A93EC416149 ON menu (id_route)');
       // $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT CURRENT_TIMESTAMP');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A93EC416149');
        $this->addSql('ALTER TABLE param DROP CONSTRAINT FK_A4FA7C89EC416149');
        $this->addSql('ALTER TABLE routes_roles DROP CONSTRAINT FK_5E8606EEC416149');
        $this->addSql('DROP SEQUENCE param_id_param_seq CASCADE');
        $this->addSql('DROP SEQUENCE route_id_route_seq CASCADE');
        $this->addSql('CREATE TABLE menus_roles (id_menu INT NOT NULL, id_role INT NOT NULL, PRIMARY KEY(id_menu, id_role))');
        $this->addSql('CREATE INDEX idx_e75cc96bf6252691 ON menus_roles (id_menu)');
        $this->addSql('CREATE INDEX idx_e75cc96bdc499668 ON menus_roles (id_role)');
        $this->addSql('ALTER TABLE menus_roles ADD CONSTRAINT fk_e75cc96bf6252691 FOREIGN KEY (id_menu) REFERENCES menu (id_menu) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menus_roles ADD CONSTRAINT fk_e75cc96bdc499668 FOREIGN KEY (id_role) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE param');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE routes_roles');
        $this->addSql('DROP INDEX IDX_7D053A93EC416149');
        $this->addSql('ALTER TABLE menu ADD path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD parametro VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE menu DROP id_route');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
    }
}
