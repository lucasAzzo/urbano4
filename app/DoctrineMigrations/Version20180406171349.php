<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180406171349 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE routes_roles (id_role INT NOT NULL, id_route INT NOT NULL, PRIMARY KEY(id_role, id_route))');
        $this->addSql('CREATE INDEX IDX_5E8606EDC499668 ON routes_roles (id_role)');
        $this->addSql('CREATE INDEX IDX_5E8606EEC416149 ON routes_roles (id_route)');
        $this->addSql('ALTER TABLE routes_roles ADD CONSTRAINT FK_5E8606EDC499668 FOREIGN KEY (id_role) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE routes_roles ADD CONSTRAINT FK_5E8606EEC416149 FOREIGN KEY (id_route) REFERENCES route (id_route) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE route ALTER parametro TYPE TEXT');
        $this->addSql('ALTER TABLE route ALTER parametro DROP DEFAULT');
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
        $this->addSql('DROP TABLE routes_roles');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE route ALTER parametro TYPE TEXT');
        $this->addSql('ALTER TABLE route ALTER parametro DROP DEFAULT');
    }
}
