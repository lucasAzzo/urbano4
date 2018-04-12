<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180411150658 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        //$this->addSql('ALTER TABLE route ALTER parametro TYPE TEXT');
        //$this->addSql('ALTER TABLE route ALTER parametro DROP DEFAULT');
        //$this->addSql('DROP INDEX "primary"');
        //$this->addSql('ALTER TABLE routes_roles ADD PRIMARY KEY (id_route, id_role)');
        $this->addSql('ALTER TABLE shipper_original ADD id_original_file INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion DROP DEFAULT');
        $this->addSql('ALTER TABLE shipper_original ADD CONSTRAINT FK_1F13065738C28C43 FOREIGN KEY (id_original_file) REFERENCES original_file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1F13065738C28C43 ON shipper_original (id_original_file)');
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
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
        $this->addSql('DROP INDEX routes_roles_pkey');
        $this->addSql('ALTER TABLE routes_roles ADD PRIMARY KEY (id_role, id_route)');
        $this->addSql('ALTER TABLE route ALTER parametro TYPE TEXT');
        $this->addSql('ALTER TABLE route ALTER parametro DROP DEFAULT');
        $this->addSql('ALTER TABLE shipper_original DROP CONSTRAINT FK_1F13065738C28C43');
        $this->addSql('DROP INDEX IDX_1F13065738C28C43');
        $this->addSql('ALTER TABLE shipper_original DROP id_original_file');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion TYPE TEXT');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion DROP DEFAULT');
    }
}
