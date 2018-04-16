<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180413143417 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO categoria (id, categoria) VALUES (1, 'COLABORADORES');");
        $this->addSql("INSERT INTO categoria (id, categoria) VALUES (2, 'FLETEROS');");
        $this->addSql("INSERT INTO categoria (id, categoria) VALUES (3, 'EJECUTIVOS');");
        $this->addSql("INSERT INTO categoria (id, categoria) VALUES (4, 'CHOFERES');");
        $this->addSql("INSERT INTO ciudad (id, ciudad) VALUES (1, 'Buenos Aires');");
        $this->addSql("INSERT INTO ciudad (id, ciudad) VALUES (2, 'Rosario');");
        $this->addSql("INSERT INTO ciudad (id, ciudad) VALUES (3, 'Córdoba');");
        $this->addSql("INSERT INTO ciudad (id, ciudad) VALUES (4, 'Mendoza');");
        $this->addSql("INSERT INTO contacto_tipo (id, contacto_tipo) VALUES (1, 'TELEFONO PERSONAL');");
        $this->addSql("INSERT INTO contacto_tipo (id, contacto_tipo) VALUES (2, 'TELEFONO LABORAL');");
        $this->addSql("INSERT INTO contacto_tipo (id, contacto_tipo) VALUES (3, 'EMAIL');");
        $this->addSql("INSERT INTO contacto_tipo (id, contacto_tipo) VALUES (4, 'FAX');");
        $this->addSql("INSERT INTO contacto_tipo (id, contacto_tipo) VALUES (5, 'OTRO');");
        $this->addSql("INSERT INTO documento_tipo (id, documento_tipo) VALUES (1, 'LIBRETA ELECTORAL O DNI');");
        $this->addSql("INSERT INTO documento_tipo (id, documento_tipo) VALUES (2, 'CARNET DE EXTRANJERIA');");
        $this->addSql("INSERT INTO documento_tipo (id, documento_tipo) VALUES (3, 'PASAPORTE');");
        $this->addSql("INSERT INTO documento_tipo (id, documento_tipo) VALUES (4, 'PART. DE NACIMIENTO-IDENTIDAD');");
        $this->addSql("INSERT INTO documento_tipo (id, documento_tipo) VALUES (5, 'CUIT');");
        $this->addSql("INSERT INTO documento_tipo (id, documento_tipo) VALUES (6, 'CUIL');");
        $this->addSql("INSERT INTO domicilio_tipo (id, domicilio_tipo) VALUES (1, 'PARTICULAR');");
        $this->addSql("INSERT INTO domicilio_tipo (id, domicilio_tipo) VALUES (2, 'FISCAL');");
        $this->addSql("INSERT INTO domicilio_tipo (id, domicilio_tipo) VALUES (3, 'LABORAL');");
        $this->addSql("INSERT INTO estado (id, estado, abreviado) VALUES (1, 'ACTIVO', 'AC');");
        $this->addSql("INSERT INTO estado (id, estado, abreviado) VALUES (2, 'INACTIVO', 'IN');");
        $this->addSql("INSERT INTO estado (id, estado, abreviado) VALUES (3, 'ANULADO', 'AN');");
        $this->addSql("INSERT INTO estado (id, estado, abreviado) VALUES (4, 'PROCESADO', 'PR');");
        $this->addSql("INSERT INTO idioma (id, idioma, abreviado) VALUES (1, 'ESPAÑOL', 'ESP');");
        $this->addSql("INSERT INTO idioma (id, idioma, abreviado) VALUES (2, 'INGLÉS', 'ING');");
        $this->addSql("INSERT INTO idioma (id, idioma, abreviado) VALUES (3, 'ITALIANO', 'ITA');");
        $this->addSql("INSERT INTO idioma (id, idioma, abreviado) VALUES (4, 'ALEMÁN', 'ALE');");
        $this->addSql("INSERT INTO idioma (id, idioma, abreviado) VALUES (5, 'JAPONÉS', 'JAP');");
        $this->addSql("INSERT INTO idioma (id, idioma, abreviado) VALUES (6, 'FRANCÉS', 'FRA');");
        $this->addSql("INSERT INTO idioma (id, idioma, abreviado) VALUES (7, 'MANDARÍN', 'MAN');");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (1, NULL, 'ABM', 10, 'dashboard', NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (13, NULL, 'CONFIGURACIÓN', 20, 'dashboard', NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (2, 1, 'SHIPPERS', 10, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (3, 1, 'SUCURSALES', 20, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (4, 1, 'PRODUCTOS', 30, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (5, 1, 'ZONAS', 40, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (6, 1, 'COLABORADORES', 50, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (7, 1, 'FLETEROS', 60, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (8, 1, 'EJECUTIVOS', 70, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (9, 1, 'CHOFERES', 80, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (11, 1, 'ESTADOS', 100, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (12, 1, 'USUARIOS', 110, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (10, 1, 'ROLES', 120, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (14, 13, 'MENÚ', 10, NULL, NULL);");
        $this->addSql("INSERT INTO menu (id, id_menu_padre, nombre, orden, icono, id_route) VALUES (15, 13, 'Rutas', 20, NULL, NULL);");
        $this->addSql("INSERT INTO pais (id, pais) VALUES (1, 'Argentina');");
        $this->addSql("INSERT INTO pais (id, pais) VALUES (2, 'Chile');");
        $this->addSql("INSERT INTO pais (id, pais) VALUES (3, 'Ecuador');");
        $this->addSql("INSERT INTO pais (id, pais) VALUES (4, 'Perú');");
        $this->addSql("INSERT INTO provincia (id, provincia) VALUES (1, 'Buenos Aires');");
        $this->addSql("INSERT INTO provincia (id, provincia) VALUES (2, 'Rosario');");
        $this->addSql("INSERT INTO provincia (id, provincia) VALUES (3, 'Córdoba');");
        $this->addSql("INSERT INTO provincia (id, provincia) VALUES (4, 'Mendoza');");
        $this->addSql("INSERT INTO region (id, region) VALUES (1, 'Norte');");
        $this->addSql("INSERT INTO region (id, region) VALUES (2, 'Sur');");
        $this->addSql("INSERT INTO region (id, region) VALUES (3, 'Este');");
        $this->addSql("INSERT INTO region (id, region) VALUES (4, 'Oeste');");
        $this->addSql("INSERT INTO roles (id, role, description, id_role_padre) VALUES (1, 'ROLE_USER', NULL, NULL);");
        $this->addSql("INSERT INTO roles (id, role, description, id_role_padre) VALUES (2, 'ROLE_ADMIN', NULL, NULL);");
        $this->addSql("INSERT INTO roles (id, role, description, id_role_padre) VALUES (3, 'ROLE_EDITOR', NULL, NULL);");
        $this->addSql("INSERT INTO roles (id, role, description, id_role_padre) VALUES (4, 'ROLE_WRITTER', NULL, NULL);");
        $this->addSql("INSERT INTO roles (id, role, description, id_role_padre) VALUES (5, 'ROLE_PRUEBA', 'ALGUNA', 2);");
        $this->addSql("INSERT INTO zona (id, zona) VALUES (1, 'Sur');");
        $this->addSql("INSERT INTO zona (id, zona) VALUES (2, 'Norte');");
        $this->addSql("INSERT INTO zona (id, zona) VALUES (3, 'Este');");
        $this->addSql("INSERT INTO zona (id, zona) VALUES (4, 'Oeste');");
        $this->addSql("INSERT INTO sucursal (id, sucursal, id_zona) VALUES (1, 'Sucursal 1', 1);");
        $this->addSql("INSERT INTO sucursal (id, sucursal, id_zona) VALUES (2, 'Sucursal 2', 2);");
        $this->addSql("INSERT INTO sucursal (id, sucursal, id_zona) VALUES (3, 'Sucursal 3', 2);");
        $this->addSql("INSERT INTO sucursal (id, sucursal, id_zona) VALUES (4, 'Sucursal 4', 3);");
        $this->addSql("INSERT INTO fos_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles) VALUES (1, 'admin', 'admin', 'admin@urbano.com.ar', 'admin@urbano.com.ar', true, null, '$2y$13\$pcochpoq9tJvADBq7BoDmuYgSuxyE1gkTy3TKds9.5beu3y3WGTJy', '2018-04-13 11:37:52', null, null, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
