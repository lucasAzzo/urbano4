<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180413143411 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE domicilio_tipo_id_domicilio_tipo_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categoria (id SERIAL NOT NULL, categoria VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4E10122D4E10122D ON categoria (categoria)');
        $this->addSql('CREATE TABLE persona_categoria (id SERIAL NOT NULL, id_categoria INT DEFAULT NULL, id_persona INT DEFAULT NULL, puesto VARCHAR(255) NOT NULL, descripcion_puesto TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4F2BB03FCE25AE0A ON persona_categoria (id_categoria)');
        $this->addSql('CREATE INDEX IDX_4F2BB03F8F781FEB ON persona_categoria (id_persona)');
        $this->addSql('CREATE INDEX IX_Relationship7 ON persona_categoria (id)');
        $this->addSql('CREATE INDEX IX_Relationship8 ON persona_categoria (id)');
        $this->addSql('CREATE TABLE shipper_original (id SERIAL NOT NULL, id_shipper INT DEFAULT NULL, id_usuario INT DEFAULT NULL, id_original_file INT DEFAULT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F13065777BB638D ON shipper_original (id_shipper)');
        $this->addSql('CREATE INDEX IDX_1F130657FCF8192D ON shipper_original (id_usuario)');
        $this->addSql('CREATE INDEX IDX_1F13065738C28C43 ON shipper_original (id_original_file)');
        $this->addSql('CREATE TABLE persona_domicilio (id SERIAL NOT NULL, id_domicilio_tipo INT DEFAULT NULL, id_persona INT DEFAULT NULL, calle VARCHAR(82) NOT NULL, numero VARCHAR(20) NOT NULL, piso VARCHAR(3) DEFAULT NULL, depto VARCHAR(3) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IX_Relationship9 ON persona_domicilio (id_persona)');
        $this->addSql('CREATE INDEX IX_Relationship10 ON persona_domicilio (id_domicilio_tipo)');
        $this->addSql('CREATE TABLE persona (id SERIAL NOT NULL, nombre VARCHAR(255) DEFAULT NULL, apellido VARCHAR(255) DEFAULT NULL, razon_social VARCHAR(255) DEFAULT NULL, apodo VARCHAR(255) DEFAULT NULL, edad INT DEFAULT NULL, fecha_nacimiento DATE DEFAULT NULL, fecha_inicio_actividad DATE DEFAULT NULL, fisica_juridica VARCHAR(1) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE fos_group (id SERIAL NOT NULL, name VARCHAR(180) NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4B019DDB5E237E06 ON fos_group (name)');
        $this->addSql('COMMENT ON COLUMN fos_group.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE tarifario (id SERIAL NOT NULL, id_producto INT DEFAULT NULL, id_shipper INT DEFAULT NULL, id_sucursal INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A8A4BB50F760EA80 ON tarifario (id_producto)');
        $this->addSql('CREATE INDEX IDX_A8A4BB5077BB638D ON tarifario (id_shipper)');
        $this->addSql('CREATE INDEX IDX_A8A4BB50B94781C3 ON tarifario (id_sucursal)');
        $this->addSql('CREATE TABLE documento_tipo (id SERIAL NOT NULL, documento_tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE domicilio_tipo (id INT NOT NULL, domicilio_tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE legajo (id SERIAL NOT NULL, legajo_numero VARCHAR(8) NOT NULL, empresa VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE idioma (id SERIAL NOT NULL, idioma VARCHAR(255) NOT NULL, abreviado VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE original_file (id SERIAL NOT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, nombre_archivo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sucursal (id SERIAL NOT NULL, id_zona INT DEFAULT NULL, sucursal VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E99C6D562CA6181C ON sucursal (id_zona)');
        $this->addSql('CREATE TABLE region (id SERIAL NOT NULL, region VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subzona (id SERIAL NOT NULL, id_zona INT DEFAULT NULL, subzona VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7E3376952CA6181C ON subzona (id_zona)');
        $this->addSql('CREATE TABLE zona (id SERIAL NOT NULL, zona VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE route (id SERIAL NOT NULL, path VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, parametro TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN route.parametro IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE routes_roles (id_route INT NOT NULL, id_role INT NOT NULL, PRIMARY KEY(id_route, id_role))');
        $this->addSql('CREATE INDEX IDX_5E8606EEC416149 ON routes_roles (id_route)');
        $this->addSql('CREATE INDEX IDX_5E8606EDC499668 ON routes_roles (id_role)');
        $this->addSql('CREATE TABLE persona_idioma (id SERIAL NOT NULL, id_persona INT DEFAULT NULL, id_idioma INT DEFAULT NULL, nivel VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IX_Relationship11 ON persona_idioma (id_idioma)');
        $this->addSql('CREATE INDEX IX_Relationship12 ON persona_idioma (id_persona)');
        $this->addSql('CREATE UNIQUE INDEX persona_idioma_unique ON persona_idioma (id_persona, id_idioma)');
        $this->addSql('CREATE TABLE menu (id SERIAL NOT NULL, id_menu_padre INT DEFAULT NULL, id_route INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, orden INT NOT NULL, icono VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7D053A93E743C95B ON menu (id_menu_padre)');
        $this->addSql('CREATE INDEX IDX_7D053A93EC416149 ON menu (id_route)');
        $this->addSql('CREATE TABLE pais (id SERIAL NOT NULL, pais VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE fos_user (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479C05FB297 ON fos_user (confirmation_token)');
        $this->addSql('COMMENT ON COLUMN fos_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('CREATE INDEX IDX_B3C77447A76ED395 ON fos_user_user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_B3C77447FE54D947 ON fos_user_user_group (group_id)');
        $this->addSql('CREATE TABLE roles (id SERIAL NOT NULL, id_role_padre INT DEFAULT NULL, role VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B63E2EC757698A6A ON roles (role)');
        $this->addSql('CREATE INDEX IDX_B63E2EC781330213 ON roles (id_role_padre)');
        $this->addSql('CREATE TABLE provincia (id SERIAL NOT NULL, provincia VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE file_structure_std (id SERIAL NOT NULL, nombre_campo VARCHAR(255) NOT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE persona_contacto (id SERIAL NOT NULL, id_persona INT DEFAULT NULL, id_contacto_tipo INT DEFAULT NULL, numero_contacto VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IX_Relationship4 ON persona_contacto (id_contacto_tipo)');
        $this->addSql('CREATE INDEX IX_Relationship5 ON persona_contacto (id_persona)');
        $this->addSql('CREATE TABLE ciudad (id SERIAL NOT NULL, ciudad VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE shipper (id SERIAL NOT NULL, id_pais INT DEFAULT NULL, id_provincia INT DEFAULT NULL, id_region INT DEFAULT NULL, id_ciudad INT DEFAULT NULL, id_sucursal_defecto INT DEFAULT NULL, id_estado INT DEFAULT NULL, id_usuario INT DEFAULT NULL, shi_representante VARCHAR(50) NOT NULL, shi_razon_social VARCHAR(50) NOT NULL, shi_direccion VARCHAR(100) NOT NULL, shi_telefono VARCHAR(20) NOT NULL, shi_cuit VARCHAR(20) NOT NULL, shi_observacion VARCHAR(100) DEFAULT NULL, aud_fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, aud_fecha_proc DATE NOT NULL, aud_hora_proc VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A926CAFDF57D32FD ON shipper (id_pais)');
        $this->addSql('CREATE INDEX IDX_A926CAFD53AF4E34 ON shipper (id_provincia)');
        $this->addSql('CREATE INDEX IDX_A926CAFD2955449B ON shipper (id_region)');
        $this->addSql('CREATE INDEX IDX_A926CAFDA8B1B073 ON shipper (id_ciudad)');
        $this->addSql('CREATE INDEX IDX_A926CAFDDD6309A1 ON shipper (id_sucursal_defecto)');
        $this->addSql('CREATE INDEX IDX_A926CAFD6A540E ON shipper (id_estado)');
        $this->addSql('CREATE INDEX IDX_A926CAFDFCF8192D ON shipper (id_usuario)');
        $this->addSql('CREATE TABLE file_structure_shipper (id SERIAL NOT NULL, nombre_campo_shipper VARCHAR(255) NOT NULL, orden INT NOT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE upload (id SERIAL NOT NULL, upload_timestamp TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, upload_file VARCHAR(255) NOT NULL, upload_shippers VARCHAR(255) NOT NULL, upload_registros VARCHAR(255) NOT NULL, upload_user VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contacto_tipo (id SERIAL NOT NULL, contacto_tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE producto (id SERIAL NOT NULL, producto VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE estado (id SERIAL NOT NULL, estado VARCHAR(255) NOT NULL, abreviado VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE transporte (id SERIAL NOT NULL, transporte VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE persona_documento (id SERIAL NOT NULL, id_persona INT DEFAULT NULL, id_documento_tipo INT DEFAULT NULL, numero VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B78A8CD58F781FEB ON persona_documento (id_persona)');
        $this->addSql('CREATE INDEX IDX_B78A8CD57DB5A185 ON persona_documento (id_documento_tipo)');
        $this->addSql('CREATE INDEX IX_Relationship2 ON persona_documento (id)');
        $this->addSql('CREATE INDEX IX_Relationship3 ON persona_documento (id)');
        $this->addSql('ALTER TABLE persona_categoria ADD CONSTRAINT FK_4F2BB03FCE25AE0A FOREIGN KEY (id_categoria) REFERENCES categoria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_categoria ADD CONSTRAINT FK_4F2BB03F8F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper_original ADD CONSTRAINT FK_1F13065777BB638D FOREIGN KEY (id_shipper) REFERENCES shipper (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper_original ADD CONSTRAINT FK_1F130657FCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper_original ADD CONSTRAINT FK_1F13065738C28C43 FOREIGN KEY (id_original_file) REFERENCES original_file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_domicilio ADD CONSTRAINT FK_9AAF8CC38CB91D43 FOREIGN KEY (id_domicilio_tipo) REFERENCES domicilio_tipo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_domicilio ADD CONSTRAINT FK_9AAF8CC38F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona ADD CONSTRAINT FK_51E5B69BBF396750 FOREIGN KEY (id) REFERENCES estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarifario ADD CONSTRAINT FK_A8A4BB50F760EA80 FOREIGN KEY (id_producto) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarifario ADD CONSTRAINT FK_A8A4BB5077BB638D FOREIGN KEY (id_shipper) REFERENCES shipper (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarifario ADD CONSTRAINT FK_A8A4BB50B94781C3 FOREIGN KEY (id_sucursal) REFERENCES sucursal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sucursal ADD CONSTRAINT FK_E99C6D562CA6181C FOREIGN KEY (id_zona) REFERENCES zona (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subzona ADD CONSTRAINT FK_7E3376952CA6181C FOREIGN KEY (id_zona) REFERENCES zona (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE routes_roles ADD CONSTRAINT FK_5E8606EEC416149 FOREIGN KEY (id_route) REFERENCES route (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE routes_roles ADD CONSTRAINT FK_5E8606EDC499668 FOREIGN KEY (id_role) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_idioma ADD CONSTRAINT FK_56224B498F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_idioma ADD CONSTRAINT FK_56224B493BFFEBE1 FOREIGN KEY (id_idioma) REFERENCES idioma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93E743C95B FOREIGN KEY (id_menu_padre) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93EC416149 FOREIGN KEY (id_route) REFERENCES route (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC781330213 FOREIGN KEY (id_role_padre) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_contacto ADD CONSTRAINT FK_C7925D7D8F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_contacto ADD CONSTRAINT FK_C7925D7DBA70AB9B FOREIGN KEY (id_contacto_tipo) REFERENCES contacto_tipo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFDF57D32FD FOREIGN KEY (id_pais) REFERENCES pais (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFD53AF4E34 FOREIGN KEY (id_provincia) REFERENCES provincia (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFD2955449B FOREIGN KEY (id_region) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFDA8B1B073 FOREIGN KEY (id_ciudad) REFERENCES ciudad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFDDD6309A1 FOREIGN KEY (id_sucursal_defecto) REFERENCES sucursal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFD6A540E FOREIGN KEY (id_estado) REFERENCES estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shipper ADD CONSTRAINT FK_A926CAFDFCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_documento ADD CONSTRAINT FK_B78A8CD58F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persona_documento ADD CONSTRAINT FK_B78A8CD57DB5A185 FOREIGN KEY (id_documento_tipo) REFERENCES documento_tipo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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
        $this->addSql('ALTER TABLE persona_categoria DROP CONSTRAINT FK_4F2BB03F8F781FEB');
        $this->addSql('ALTER TABLE persona_domicilio DROP CONSTRAINT FK_9AAF8CC38F781FEB');
        $this->addSql('ALTER TABLE persona_idioma DROP CONSTRAINT FK_56224B498F781FEB');
        $this->addSql('ALTER TABLE persona_contacto DROP CONSTRAINT FK_C7925D7D8F781FEB');
        $this->addSql('ALTER TABLE persona_documento DROP CONSTRAINT FK_B78A8CD58F781FEB');
        $this->addSql('ALTER TABLE fos_user_user_group DROP CONSTRAINT FK_B3C77447FE54D947');
        $this->addSql('ALTER TABLE persona_documento DROP CONSTRAINT FK_B78A8CD57DB5A185');
        $this->addSql('ALTER TABLE persona_domicilio DROP CONSTRAINT FK_9AAF8CC38CB91D43');
        $this->addSql('ALTER TABLE persona_idioma DROP CONSTRAINT FK_56224B493BFFEBE1');
        $this->addSql('ALTER TABLE shipper_original DROP CONSTRAINT FK_1F13065738C28C43');
        $this->addSql('ALTER TABLE tarifario DROP CONSTRAINT FK_A8A4BB50B94781C3');
        $this->addSql('ALTER TABLE shipper DROP CONSTRAINT FK_A926CAFDDD6309A1');
        $this->addSql('ALTER TABLE shipper DROP CONSTRAINT FK_A926CAFD2955449B');
        $this->addSql('ALTER TABLE sucursal DROP CONSTRAINT FK_E99C6D562CA6181C');
        $this->addSql('ALTER TABLE subzona DROP CONSTRAINT FK_7E3376952CA6181C');
        $this->addSql('ALTER TABLE routes_roles DROP CONSTRAINT FK_5E8606EEC416149');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A93EC416149');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A93E743C95B');
        $this->addSql('ALTER TABLE shipper DROP CONSTRAINT FK_A926CAFDF57D32FD');
        $this->addSql('ALTER TABLE shipper_original DROP CONSTRAINT FK_1F130657FCF8192D');
        $this->addSql('ALTER TABLE fos_user_user_group DROP CONSTRAINT FK_B3C77447A76ED395');
        $this->addSql('ALTER TABLE shipper DROP CONSTRAINT FK_A926CAFDFCF8192D');
        $this->addSql('ALTER TABLE routes_roles DROP CONSTRAINT FK_5E8606EDC499668');
        $this->addSql('ALTER TABLE roles DROP CONSTRAINT FK_B63E2EC781330213');
        $this->addSql('ALTER TABLE shipper DROP CONSTRAINT FK_A926CAFD53AF4E34');
        $this->addSql('ALTER TABLE shipper DROP CONSTRAINT FK_A926CAFDA8B1B073');
        $this->addSql('ALTER TABLE shipper_original DROP CONSTRAINT FK_1F13065777BB638D');
        $this->addSql('ALTER TABLE tarifario DROP CONSTRAINT FK_A8A4BB5077BB638D');
        $this->addSql('ALTER TABLE persona_contacto DROP CONSTRAINT FK_C7925D7DBA70AB9B');
        $this->addSql('ALTER TABLE tarifario DROP CONSTRAINT FK_A8A4BB50F760EA80');
        $this->addSql('ALTER TABLE persona DROP CONSTRAINT FK_51E5B69BBF396750');
        $this->addSql('ALTER TABLE shipper DROP CONSTRAINT FK_A926CAFD6A540E');
        $this->addSql('DROP SEQUENCE domicilio_tipo_id_domicilio_tipo_seq CASCADE');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE persona_categoria');
        $this->addSql('DROP TABLE shipper_original');
        $this->addSql('DROP TABLE persona_domicilio');
        $this->addSql('DROP TABLE persona');
        $this->addSql('DROP TABLE fos_group');
        $this->addSql('DROP TABLE tarifario');
        $this->addSql('DROP TABLE documento_tipo');
        $this->addSql('DROP TABLE domicilio_tipo');
        $this->addSql('DROP TABLE legajo');
        $this->addSql('DROP TABLE idioma');
        $this->addSql('DROP TABLE original_file');
        $this->addSql('DROP TABLE sucursal');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE subzona');
        $this->addSql('DROP TABLE zona');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE routes_roles');
        $this->addSql('DROP TABLE persona_idioma');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE pais');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE provincia');
        $this->addSql('DROP TABLE file_structure_std');
        $this->addSql('DROP TABLE persona_contacto');
        $this->addSql('DROP TABLE ciudad');
        $this->addSql('DROP TABLE shipper');
        $this->addSql('DROP TABLE file_structure_shipper');
        $this->addSql('DROP TABLE upload');
        $this->addSql('DROP TABLE contacto_tipo');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE estado');
        $this->addSql('DROP TABLE transporte');
        $this->addSql('DROP TABLE persona_documento');
    }
}
