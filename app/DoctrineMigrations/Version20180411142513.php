<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180411142513 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE original_shipper (id SERIAL NOT NULL, id_shipper INT DEFAULT NULL, id_usuario INT DEFAULT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, nombre_archivo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FA6640A77BB638D ON original_shipper (id_shipper)');
        $this->addSql('CREATE INDEX IDX_2FA6640AFCF8192D ON original_shipper (id_usuario)');
        $this->addSql('ALTER TABLE original_shipper ADD CONSTRAINT FK_2FA6640A77BB638D FOREIGN KEY (id_shipper) REFERENCES shipper (id_shipper) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE original_shipper ADD CONSTRAINT FK_2FA6640AFCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        //$this->addSql('ALTER TABLE route ALTER parametro TYPE TEXT');
        //$this->addSql('ALTER TABLE route ALTER parametro DROP DEFAULT');
        //$this->addSql('DROP INDEX "primary"');
        //$this->addSql('ALTER TABLE routes_roles ADD PRIMARY KEY (id_route, id_role)');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion DROP DEFAULT');
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
        $this->addSql('DROP TABLE original_shipper');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
        $this->addSql('DROP INDEX routes_roles_pkey');
        $this->addSql('ALTER TABLE routes_roles ADD PRIMARY KEY (id_role, id_route)');
        $this->addSql('ALTER TABLE route ALTER parametro TYPE TEXT');
        $this->addSql('ALTER TABLE route ALTER parametro DROP DEFAULT');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion TYPE TEXT');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion DROP DEFAULT');
    }
}
