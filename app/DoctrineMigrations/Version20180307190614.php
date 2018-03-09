<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180307190614 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE shipper_id_shipper_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE shipper (id_shipper INT NOT NULL, id_pais INT DEFAULT NULL, id_provincia INT DEFAULT NULL, id_region INT DEFAULT NULL, id_ciudad INT DEFAULT NULL, id_sucursal_defecto INT DEFAULT NULL, id_usuario INT DEFAULT NULL, shi_representante VARCHAR(50) NOT NULL, shi_razon_social VARCHAR(50) NOT NULL, shi_direccion VARCHAR(100) NOT NULL, shi_telefono VARCHAR(20) NOT NULL, shi_cuit VARCHAR(20) NOT NULL, shi_observacion VARCHAR(100) DEFAULT NULL, ref_estado VARCHAR(2) NOT NULL, aud_fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, aud_fecha_proc DATE NOT NULL, aud_hora_proc VARCHAR(5) NOT NULL, PRIMARY KEY(id_shipper))');
        $this->addSql('CREATE INDEX IDX_A926CAFDF57D32FD ON shipper (id_pais)');
        $this->addSql('CREATE INDEX IDX_A926CAFD53AF4E34 ON shipper (id_provincia)');
        $this->addSql('CREATE INDEX IDX_A926CAFD2955449B ON shipper (id_region)');
        $this->addSql('CREATE INDEX IDX_A926CAFDA8B1B073 ON shipper (id_ciudad)');
        $this->addSql('CREATE INDEX IDX_A926CAFDDD6309A1 ON shipper (id_sucursal_defecto)');
        $this->addSql('CREATE INDEX IDX_A926CAFDFCF8192D ON shipper (id_usuario)');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFDF57D32FD FOREIGN KEY (id_pais) REFERENCES pais (id_pais) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFD53AF4E34 FOREIGN KEY (id_provincia) REFERENCES provincia (id_provincia) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFD2955449B FOREIGN KEY (id_region) REFERENCES region (id_region) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFDA8B1B073 FOREIGN KEY (id_ciudad) REFERENCES ciudad (id_ciudad) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFDDD6309A1 FOREIGN KEY (id_sucursal_defecto) REFERENCES sucursal (id_sucursal) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFDFCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE shipper_id_shipper_seq CASCADE');
        $this->addSql('DROP TABLE shipper');
    }
}
