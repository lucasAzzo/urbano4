<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180308184416 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE categoria_id_categoria_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contacto_tipo_id_contacto_tipo_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE documento_tipo_id_documento_tipo_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE domicilio_tipo_id_domicilio_tipo_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE idioma_id_idioma_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE legajo_id_legajo_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE persona_id_persona_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE persona_categoria_id_persona_categoria_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE persona_contacto_id_persona_contacto_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE persona_documento_id_persona_documento_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE persona_domicilio_id_persona_domicilio_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE persona_idioma_id_persona_idioma_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tarifario_id_tarifario_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE transporte_id_transporte_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categoria (id_categoria INT NOT NULL, categoria VARCHAR(255) NOT NULL, PRIMARY KEY(id_categoria))');
        $this->addSql('CREATE TABLE contacto_tipo (id_contacto_tipo INT NOT NULL, contacto_tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id_contacto_tipo))');
        $this->addSql('CREATE TABLE documento_tipo (id_documento_tipo INT NOT NULL, documento_tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id_documento_tipo))');
        $this->addSql('CREATE TABLE domicilio_tipo (id_domicilio_tipo INT NOT NULL, domicilio_tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id_domicilio_tipo))');
        $this->addSql('CREATE TABLE idioma (id_idioma INT NOT NULL, idioma VARCHAR(255) NOT NULL, abreviado VARCHAR(10) NOT NULL, PRIMARY KEY(id_idioma))');
        $this->addSql('CREATE TABLE legajo (id_legajo INT NOT NULL, id_persona INT DEFAULT NULL, ref_estado VARCHAR(2) NOT NULL, legajo_numero VARCHAR(8) NOT NULL, empresa VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id_legajo))');
        $this->addSql('CREATE INDEX IDX_32DD07F68F781FEB ON legajo (id_persona)');
        $this->addSql('CREATE TABLE persona (id_persona INT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, apellido VARCHAR(255) DEFAULT NULL, razon_social VARCHAR(255) DEFAULT NULL, apodo VARCHAR(255) DEFAULT NULL, edad INT DEFAULT NULL, fecha_nacimiento DATE DEFAULT NULL, fecha_inicio_actividad DATE DEFAULT NULL, fisica_juridica VARCHAR(1) NOT NULL, PRIMARY KEY(id_persona))');
        $this->addSql('CREATE TABLE persona_categoria (id_persona_categoria INT NOT NULL, id_categoria INT DEFAULT NULL, id_persona INT DEFAULT NULL, puesto VARCHAR(255) NOT NULL, descripcion_puesto TEXT DEFAULT NULL, PRIMARY KEY(id_persona_categoria))');
        $this->addSql('CREATE INDEX IX_Relationship7 ON persona_categoria (id_persona)');
        $this->addSql('CREATE INDEX IX_Relationship8 ON persona_categoria (id_categoria)');
        $this->addSql('CREATE TABLE persona_contacto (id_persona_contacto INT NOT NULL, id_persona INT DEFAULT NULL, id_contacto_tipo INT DEFAULT NULL, numero_contacto VARCHAR(255) NOT NULL, PRIMARY KEY(id_persona_contacto))');
        $this->addSql('CREATE INDEX IX_Relationship4 ON persona_contacto (id_contacto_tipo)');
        $this->addSql('CREATE INDEX IX_Relationship5 ON persona_contacto (id_persona)');
        $this->addSql('CREATE TABLE persona_documento (id_persona_documento INT NOT NULL, id_persona INT DEFAULT NULL, id_documento_tipo INT DEFAULT NULL, numero VARCHAR(255) NOT NULL, PRIMARY KEY(id_persona_documento))');
        $this->addSql('CREATE INDEX IX_Relationship2 ON persona_documento (id_documento_tipo)');
        $this->addSql('CREATE INDEX IX_Relationship3 ON persona_documento (id_persona)');
        $this->addSql('CREATE TABLE persona_domicilio (id_persona_domicilio INT NOT NULL, id_domicilio_tipo INT DEFAULT NULL, id_persona INT DEFAULT NULL, calle VARCHAR(82) NOT NULL, numero VARCHAR(20) NOT NULL, piso VARCHAR(3) DEFAULT NULL, depto VARCHAR(3) DEFAULT NULL, PRIMARY KEY(id_persona_domicilio))');
        $this->addSql('CREATE INDEX IX_Relationship9 ON persona_domicilio (id_persona)');
        $this->addSql('CREATE INDEX IX_Relationship10 ON persona_domicilio (id_domicilio_tipo)');
        $this->addSql('CREATE TABLE persona_idioma (id_persona_idioma INT NOT NULL, id_persona INT DEFAULT NULL, id_idioma INT DEFAULT NULL, nivel VARCHAR(255) NOT NULL, PRIMARY KEY(id_persona_idioma))');
        $this->addSql('CREATE INDEX IX_Relationship11 ON persona_idioma (id_idioma)');
        $this->addSql('CREATE INDEX IX_Relationship12 ON persona_idioma (id_persona)');
        $this->addSql('CREATE UNIQUE INDEX persona_idioma_unique ON persona_idioma (id_persona, id_idioma)');
        $this->addSql('CREATE TABLE tarifario (id_tarifario INT NOT NULL, id_producto INT DEFAULT NULL, id_shipper INT DEFAULT NULL, id_sucursal INT DEFAULT NULL, PRIMARY KEY(id_tarifario))');
        $this->addSql('CREATE INDEX IDX_A8A4BB50F760EA80 ON tarifario (id_producto)');
        $this->addSql('CREATE INDEX IDX_A8A4BB5077BB638D ON tarifario (id_shipper)');
        $this->addSql('CREATE INDEX IDX_A8A4BB50B94781C3 ON tarifario (id_sucursal)');
        $this->addSql('CREATE TABLE transporte (id_transporte INT NOT NULL, transporte VARCHAR(255) NOT NULL, PRIMARY KEY(id_transporte))');
        $this->addSql('ALTER TABLE legajo ADD CONSTRAINT FK_32DD07F68F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id_persona) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_categoria ADD CONSTRAINT FK_4F2BB03FCE25AE0A FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_categoria ADD CONSTRAINT FK_4F2BB03F8F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id_persona) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_contacto ADD CONSTRAINT FK_C7925D7D8F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id_persona) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_contacto ADD CONSTRAINT FK_C7925D7DBA70AB9B FOREIGN KEY (id_contacto_tipo) REFERENCES contacto_tipo (id_contacto_tipo) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_documento ADD CONSTRAINT FK_B78A8CD58F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id_persona) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_documento ADD CONSTRAINT FK_B78A8CD57DB5A185 FOREIGN KEY (id_documento_tipo) REFERENCES documento_tipo (id_documento_tipo) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_domicilio ADD CONSTRAINT FK_9AAF8CC38CB91D43 FOREIGN KEY (id_domicilio_tipo) REFERENCES domicilio_tipo (id_domicilio_tipo) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_domicilio ADD CONSTRAINT FK_9AAF8CC38F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id_persona) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_idioma ADD CONSTRAINT FK_56224B498F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id_persona) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_idioma ADD CONSTRAINT FK_56224B493BFFEBE1 FOREIGN KEY (id_idioma) REFERENCES idioma (id_idioma) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarifario ADD CONSTRAINT FK_A8A4BB50F760EA80 FOREIGN KEY (id_producto) REFERENCES producto (id_producto) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarifario ADD CONSTRAINT FK_A8A4BB5077BB638D FOREIGN KEY (id_shipper) REFERENCES shipper (id_shipper) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarifario ADD CONSTRAINT FK_A8A4BB50B94781C3 FOREIGN KEY (id_sucursal) REFERENCES sucursal (id_sucursal) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE persona_categoria DROP CONSTRAINT FK_4F2BB03FCE25AE0A');
        $this->addSql('ALTER TABLE persona_contacto DROP CONSTRAINT FK_C7925D7DBA70AB9B');
        $this->addSql('ALTER TABLE persona_documento DROP CONSTRAINT FK_B78A8CD57DB5A185');
        $this->addSql('ALTER TABLE persona_domicilio DROP CONSTRAINT FK_9AAF8CC38CB91D43');
        $this->addSql('ALTER TABLE persona_idioma DROP CONSTRAINT FK_56224B493BFFEBE1');
        $this->addSql('ALTER TABLE legajo DROP CONSTRAINT FK_32DD07F68F781FEB');
        $this->addSql('ALTER TABLE persona_categoria DROP CONSTRAINT FK_4F2BB03F8F781FEB');
        $this->addSql('ALTER TABLE persona_contacto DROP CONSTRAINT FK_C7925D7D8F781FEB');
        $this->addSql('ALTER TABLE persona_documento DROP CONSTRAINT FK_B78A8CD58F781FEB');
        $this->addSql('ALTER TABLE persona_domicilio DROP CONSTRAINT FK_9AAF8CC38F781FEB');
        $this->addSql('ALTER TABLE persona_idioma DROP CONSTRAINT FK_56224B498F781FEB');
        $this->addSql('DROP SEQUENCE categoria_id_categoria_seq CASCADE');
        $this->addSql('DROP SEQUENCE contacto_tipo_id_contacto_tipo_seq CASCADE');
        $this->addSql('DROP SEQUENCE documento_tipo_id_documento_tipo_seq CASCADE');
        $this->addSql('DROP SEQUENCE domicilio_tipo_id_domicilio_tipo_seq CASCADE');
        $this->addSql('DROP SEQUENCE idioma_id_idioma_seq CASCADE');
        $this->addSql('DROP SEQUENCE legajo_id_legajo_seq CASCADE');
        $this->addSql('DROP SEQUENCE persona_id_persona_seq CASCADE');
        $this->addSql('DROP SEQUENCE persona_categoria_id_persona_categoria_seq CASCADE');
        $this->addSql('DROP SEQUENCE persona_contacto_id_persona_contacto_seq CASCADE');
        $this->addSql('DROP SEQUENCE persona_documento_id_persona_documento_seq CASCADE');
        $this->addSql('DROP SEQUENCE persona_domicilio_id_persona_domicilio_seq CASCADE');
        $this->addSql('DROP SEQUENCE persona_idioma_id_persona_idioma_seq CASCADE');
        $this->addSql('DROP SEQUENCE tarifario_id_tarifario_seq CASCADE');
        $this->addSql('DROP SEQUENCE transporte_id_transporte_seq CASCADE');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE contacto_tipo');
        $this->addSql('DROP TABLE documento_tipo');
        $this->addSql('DROP TABLE domicilio_tipo');
        $this->addSql('DROP TABLE idioma');
        $this->addSql('DROP TABLE legajo');
        $this->addSql('DROP TABLE persona');
        $this->addSql('DROP TABLE persona_categoria');
        $this->addSql('DROP TABLE persona_contacto');
        $this->addSql('DROP TABLE persona_documento');
        $this->addSql('DROP TABLE persona_domicilio');
        $this->addSql('DROP TABLE persona_idioma');
        $this->addSql('DROP TABLE tarifario');
        $this->addSql('DROP TABLE transporte');
    }
}
