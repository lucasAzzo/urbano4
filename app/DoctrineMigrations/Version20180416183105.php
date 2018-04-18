<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416183105 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE chk (id SERIAL NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ModeloMail (id SERIAL NOT NULL, ModeloSms VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ModeloSms (id SERIAL NOT NULL, ModeloSms VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE Motivo (id SERIAL NOT NULL, Motivo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pedido_shipper (id SERIAL NOT NULL, id_pedido_shipper_padre INT DEFAULT NULL, id_shipper INT DEFAULT NULL, id_producto INT DEFAULT NULL, id_servicio INT DEFAULT NULL, id_modelo_sms INT DEFAULT NULL, id_modelo_mail INT DEFAULT NULL, id_sucursal_base INT DEFAULT NULL, id_sucursal_canalizacion INT DEFAULT NULL, id_sucursal_actual INT DEFAULT NULL, id_chk INT DEFAULT NULL, id_motivo INT DEFAULT NULL, total_bulto INT NOT NULL, ciclo DATE DEFAULT NULL, codigo_seguimiento VARCHAR(50) NOT NULL, codigo_alternativo VARCHAR(50) DEFAULT NULL, tipo_documento VARCHAR(50) NOT NULL, documento VARCHAR(50) NOT NULL, nombre VARCHAR(100) NOT NULL, telefono VARCHAR(50) NOT NULL, celular VARCHAR(50) NOT NULL, calle VARCHAR(50) NOT NULL, numero VARCHAR(50) NOT NULL, departamento VARCHAR(50) NOT NULL, piso VARCHAR(50) NOT NULL, codigo_postal INT NOT NULL, provincia VARCHAR(50) NOT NULL, localidad VARCHAR(50) NOT NULL, longitud VARCHAR(30) NOT NULL, latitud VARCHAR(30) NOT NULL, calle_alternativo VARCHAR(50) DEFAULT NULL, numero_alternativo VARCHAR(50) DEFAULT NULL, departamento_alternativo VARCHAR(50) DEFAULT NULL, piso_alternativo VARCHAR(50) DEFAULT NULL, codigo_postal_alternativo INT DEFAULT NULL, provincia_alternativo VARCHAR(50) DEFAULT NULL, localidad_alternativo VARCHAR(50) DEFAULT NULL, longitud_alternativo VARCHAR(30) DEFAULT NULL, latitud_alternativo VARCHAR(30) DEFAULT NULL, tipo_documento_autorizado_1 VARCHAR(30) DEFAULT NULL, documento_autorizado_1 VARCHAR(30) DEFAULT NULL, nombre_autorizado_1 VARCHAR(30) DEFAULT NULL, telefono_autorizado_1 VARCHAR(30) DEFAULT NULL, celular_autorizado_1 VARCHAR(30) DEFAULT NULL, tipo_documento_autorizado_2 VARCHAR(30) DEFAULT NULL, documento_autorizado_2 VARCHAR(30) DEFAULT NULL, nombre_autorizado_2 VARCHAR(30) DEFAULT NULL, telefono_autorizado_2 VARCHAR(30) DEFAULT NULL, celular_autorizado_2 VARCHAR(30) DEFAULT NULL, descripcion_producto VARCHAR(50) NOT NULL, sku VARCHAR(100) NOT NULL, alto NUMERIC(12, 2) NOT NULL, largo NUMERIC(12, 2) NOT NULL, ancho NUMERIC(12, 2) NOT NULL, peso_declarado NUMERIC(12, 2) NOT NULL, peso_aforado NUMERIC(12, 2) NOT NULL, valor_declarado NUMERIC(14, 2) NOT NULL, valor_contrareembolso NUMERIC(14, 2) NOT NULL, cantidad INT NOT NULL, marca_agua VARCHAR(100) NOT NULL, fecha_pactado_base DATE NOT NULL, hora_pactado_base TIME(0) WITHOUT TIME ZONE NOT NULL, fecha_hora_pactado TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, observacion1 VARCHAR(100) DEFAULT NULL, observacion2 VARCHAR(100) DEFAULT NULL, observacion3 VARCHAR(100) DEFAULT NULL, observacion4 VARCHAR(100) DEFAULT NULL, observacion5 VARCHAR(100) DEFAULT NULL, observacion6 VARCHAR(100) DEFAULT NULL, observacion7 VARCHAR(100) DEFAULT NULL, observacion8 VARCHAR(100) DEFAULT NULL, observacion9 VARCHAR(100) DEFAULT NULL, fecha_actual DATE NOT NULL, fecha_creacion DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CB5F4293E2F87E42 ON pedido_shipper (id_pedido_shipper_padre)');
        $this->addSql('CREATE INDEX IDX_CB5F429377BB638D ON pedido_shipper (id_shipper)');
        $this->addSql('CREATE INDEX IDX_CB5F4293F760EA80 ON pedido_shipper (id_producto)');
        $this->addSql('CREATE INDEX IDX_CB5F42939B5D1EBF ON pedido_shipper (id_servicio)');
        $this->addSql('CREATE INDEX IDX_CB5F4293D43E373B ON pedido_shipper (id_modelo_sms)');
        $this->addSql('CREATE INDEX IDX_CB5F42932E2836FE ON pedido_shipper (id_modelo_mail)');
        $this->addSql('CREATE INDEX IDX_CB5F42932613439B ON pedido_shipper (id_sucursal_base)');
        $this->addSql('CREATE INDEX IDX_CB5F4293C8AFA6D ON pedido_shipper (id_sucursal_canalizacion)');
        $this->addSql('CREATE INDEX IDX_CB5F429379FEBA85 ON pedido_shipper (id_sucursal_actual)');
        $this->addSql('CREATE INDEX IDX_CB5F42935C301D4E ON pedido_shipper (id_chk)');
        $this->addSql('CREATE INDEX IDX_CB5F42933FCE8D8B ON pedido_shipper (id_motivo)');
        $this->addSql('CREATE TABLE servicio (id SERIAL NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F4293E2F87E42 FOREIGN KEY (id_pedido_shipper_padre) REFERENCES pedido_shipper (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F429377BB638D FOREIGN KEY (id_shipper) REFERENCES shipper (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F4293F760EA80 FOREIGN KEY (id_producto) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F42939B5D1EBF FOREIGN KEY (id_servicio) REFERENCES servicio (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F4293D43E373B FOREIGN KEY (id_modelo_sms) REFERENCES ModeloSms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F42932E2836FE FOREIGN KEY (id_modelo_mail) REFERENCES ModeloMail (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F42932613439B FOREIGN KEY (id_sucursal_base) REFERENCES sucursal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F4293C8AFA6D FOREIGN KEY (id_sucursal_canalizacion) REFERENCES sucursal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F429379FEBA85 FOREIGN KEY (id_sucursal_actual) REFERENCES sucursal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F42935C301D4E FOREIGN KEY (id_chk) REFERENCES chk (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pedido_shipper ADD CONSTRAINT FK_CB5F42933FCE8D8B FOREIGN KEY (id_motivo) REFERENCES Motivo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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
        $this->addSql('ALTER TABLE pedido_shipper DROP CONSTRAINT FK_CB5F42935C301D4E');
        $this->addSql('ALTER TABLE pedido_shipper DROP CONSTRAINT FK_CB5F42932E2836FE');
        $this->addSql('ALTER TABLE pedido_shipper DROP CONSTRAINT FK_CB5F4293D43E373B');
        $this->addSql('ALTER TABLE pedido_shipper DROP CONSTRAINT FK_CB5F42933FCE8D8B');
        $this->addSql('ALTER TABLE pedido_shipper DROP CONSTRAINT FK_CB5F4293E2F87E42');
        $this->addSql('ALTER TABLE pedido_shipper DROP CONSTRAINT FK_CB5F42939B5D1EBF');
        $this->addSql('DROP TABLE chk');
        $this->addSql('DROP TABLE ModeloMail');
        $this->addSql('DROP TABLE ModeloSms');
        $this->addSql('DROP TABLE Motivo');
        $this->addSql('DROP TABLE pedido_shipper');
        $this->addSql('DROP TABLE servicio');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
    }
}
