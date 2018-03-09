<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180308190923 extends AbstractMigration {

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) {

        $this->addSql("INSERT INTO contacto_tipo (id_contacto_tipo, contacto_tipo) VALUES (1, 'TELEFONO PERSONAL');");
        $this->addSql("INSERT INTO contacto_tipo (id_contacto_tipo, contacto_tipo) VALUES (2, 'TELEFONO LABORAL');");
        $this->addSql("INSERT INTO contacto_tipo (id_contacto_tipo, contacto_tipo) VALUES (3, 'EMAIL');");
        $this->addSql("INSERT INTO contacto_tipo (id_contacto_tipo, contacto_tipo) VALUES (4, 'FAX');");
        $this->addSql("INSERT INTO contacto_tipo (id_contacto_tipo, contacto_tipo) VALUES (5, 'OTRO');");
        
        $this->addSql("INSERT INTO documento_tipo (id_documento_tipo, documento_tipo) VALUES (1, 'LIBRETA ELECTORAL O DNI');");
        $this->addSql("INSERT INTO documento_tipo (id_documento_tipo, documento_tipo) VALUES (2, 'CARNET DE EXTRANJERIA');");
        $this->addSql("INSERT INTO documento_tipo (id_documento_tipo, documento_tipo) VALUES (3, 'PASAPORTE');");
        $this->addSql("INSERT INTO documento_tipo (id_documento_tipo, documento_tipo) VALUES (4, 'PART. DE NACIMIENTO-IDENTIDAD');");
        $this->addSql("INSERT INTO documento_tipo (id_documento_tipo, documento_tipo) VALUES (5, 'CUIT');");
        $this->addSql("INSERT INTO documento_tipo (id_documento_tipo, documento_tipo) VALUES (6, 'CUIL');");
        
        $this->addSql("INSERT INTO domicilio_tipo (id_domicilio_tipo, domicilio_tipo) VALUES (1, 'PARTICULAR');");
        $this->addSql("INSERT INTO domicilio_tipo (id_domicilio_tipo, domicilio_tipo) VALUES (2, 'FISCAL');");
        $this->addSql("INSERT INTO domicilio_tipo (id_domicilio_tipo, domicilio_tipo) VALUES (3, 'LABORAL');");
        
        $this->addSql("INSERT INTO idioma (id_idioma, idioma, abreviado) VALUES (1, 'ESPAÑOL', 'ESP');");
        $this->addSql("INSERT INTO idioma (id_idioma, idioma, abreviado) VALUES (2, 'INGLÉS', 'ING');");
        $this->addSql("INSERT INTO idioma (id_idioma, idioma, abreviado) VALUES (3, 'ITALIANO', 'ITA');");
        $this->addSql("INSERT INTO idioma (id_idioma, idioma, abreviado) VALUES (4, 'ALEMÁN', 'ALE');");
        $this->addSql("INSERT INTO idioma (id_idioma, idioma, abreviado) VALUES (5, 'JAPONÉS', 'JAP');");
        $this->addSql("INSERT INTO idioma (id_idioma, idioma, abreviado) VALUES (6, 'FRANCÉS', 'FRA');");
        $this->addSql("INSERT INTO idioma (id_idioma, idioma, abreviado) VALUES (7, 'MANDARÍN', 'MAN');");
        

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }

}
