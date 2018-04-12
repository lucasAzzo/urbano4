<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180411150343 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE original_shipper_id_seq CASCADE');
        $this->addSql('CREATE TABLE original_file (id SERIAL NOT NULL, id_shipper INT DEFAULT NULL, id_usuario INT DEFAULT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, nombre_archivo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_86EA5D2677BB638D ON original_file (id_shipper)');
        $this->addSql('CREATE INDEX IDX_86EA5D26FCF8192D ON original_file (id_usuario)');
        $this->addSql('ALTER TABLE original_file ADD CONSTRAINT FK_86EA5D2677BB638D FOREIGN KEY (id_shipper) REFERENCES shipper (id_shipper) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE original_file ADD CONSTRAINT FK_86EA5D26FCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE original_shipper');
        //$this->addSql('ALTER TABLE route ALTER parametro TYPE TEXT');
        //$this->addSql('ALTER TABLE route ALTER parametro DROP DEFAULT');
        //$this->addSql('DROP INDEX "primary"');
        //$this->addSql('ALTER TABLE routes_roles ADD PRIMARY KEY (id_route, id_role)');
        //$this->addSql('ALTER TABLE shipper_original ALTER descripcion TYPE VARCHAR(255)');
        //$this->addSql('ALTER TABLE shipper_original ALTER descripcion DROP DEFAULT');
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
        $this->addSql('CREATE SEQUENCE original_shipper_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE original_shipper (id SERIAL NOT NULL, id_shipper INT DEFAULT NULL, id_usuario INT DEFAULT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, nombre_archivo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_2fa6640afcf8192d ON original_shipper (id_usuario)');
        $this->addSql('CREATE INDEX idx_2fa6640a77bb638d ON original_shipper (id_shipper)');
        $this->addSql('ALTER TABLE original_shipper ADD CONSTRAINT fk_2fa6640a77bb638d FOREIGN KEY (id_shipper) REFERENCES shipper (id_shipper) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE original_shipper ADD CONSTRAINT fk_2fa6640afcf8192d FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE original_file');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
        $this->addSql('DROP INDEX routes_roles_pkey');
        $this->addSql('ALTER TABLE routes_roles ADD PRIMARY KEY (id_role, id_route)');
        $this->addSql('ALTER TABLE route ALTER parametro TYPE TEXT');
        $this->addSql('ALTER TABLE route ALTER parametro DROP DEFAULT');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion TYPE TEXT');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion DROP DEFAULT');
    }
}
