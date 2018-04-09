<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319141627 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        /*$this->addSql("INSERT INTO route(id_route, path, name) VALUES (1, '/estado_index', 'estado_index');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (2, '/estado_new', 'estado_new');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (3, '/estado_create', 'estado_create');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (4, '/estado_edit', 'estado_edit');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (5, '/estado_update', 'estado_update');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (6, '/estado_delete', 'estado_delete');");
        
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (7, '/persona_index', 'persona_index');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (8, '/persona_new', 'persona_new');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (9, '/persona_create', 'persona_create');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (10, '/persona_edit', 'persona_edit');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (11, '/persona_update', 'persona_update');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (12, '/persona_delete', 'persona_delete');");
        
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (13, '/producto_index', 'producto_index');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (14, '/producto_new', 'producto_new');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (15, '/producto_create', 'producto_create');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (16, '/producto_edit', 'producto_edit');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (17, '/producto_update', 'producto_update');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (18, '/producto_delete', 'producto_delete');");
        
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (19, '/roles_index', 'roles_index');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (20, '/roles_new', 'roles_new');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (21, '/roles_create', 'roles_create');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (22, '/roles_edit', 'roles_edit');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (23, '/roles_update', 'roles_update');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (24, '/roles_delete', 'roles_delete');");
        
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (25, '/shipper_index', 'shipper_index');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (26, '/shipper_new', 'shipper_new');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (27, '/shipper_create', 'shipper_create');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (28, '/shipper_edit', 'shipper_edit');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (29, '/shipper_update', 'shipper_update');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (30, '/shipper_delete', 'shipper_delete');");
        
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (31, '/sucursal_index', 'sucursal_index');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (32, '/sucursal_new', 'sucursal_new');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (33, '/sucursal_create', 'sucursal_create');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (34, '/sucursal_edit', 'sucursal_edit');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (35, '/sucursal_update', 'sucursal_update');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (36, '/sucursal_delete', 'sucursal_delete');");
        
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (37, '/users_index', 'users_index');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (38, '/users_new', 'users_new');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (39, '/users_create', 'users_create');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (40, '/users_edit', 'users_edit');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (41, '/users_update', 'users_update');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (42, '/users_delete', 'users_delete');");
        
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (43, '/zona_index', 'zona_index');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (44, '/zona_new', 'zona_new');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (45, '/zona_create', 'zona_create');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (46, '/zona_edit', 'zona_edit');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (47, '/zona_update', 'zona_update');");
        $this->addSql("INSERT INTO route(id_route, path, name) VALUES (48, '/zona_delete', 'zona_delete');");
        
        $this->addSql("update menu set id_route=25 where id_menu=2;");
        $this->addSql("update menu set id_route=31 where id_menu=3;");
        $this->addSql("update menu set id_route=13 where id_menu=4;");
        $this->addSql("update menu set id_route=43 where id_menu=5;");
        $this->addSql("update menu set id_route=7 where id_menu=6;");
        $this->addSql("update menu set id_route=7 where id_menu=7;");
        $this->addSql("update menu set id_route=7 where id_menu=8;");
        $this->addSql("update menu set id_route=7 where id_menu=9;");
        $this->addSql("update menu set id_route=19 where id_menu=10;");
        $this->addSql("update menu set id_route=1 where id_menu=11;");
        $this->addSql("update menu set id_route=37 where id_menu=12;");
        
        $this->addSql("INSERT INTO param(id_param, id_route, name, value) VALUES (1, 7, 'categoria', '1|2|3|4');");
        
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (1, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (2, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (3, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (4, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (5, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (6, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (7, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (8, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (9, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (10, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (11, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (12, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (13, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (14, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (15, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (16, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (17, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (18, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (19, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (20, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (21, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (22, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (23, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (24, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (25, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (26, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (27, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (28, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (29, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (30, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (31, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (32, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (33, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (34, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (35, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (36, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (37, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (38, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (39, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (40, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (41, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (42, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (43, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (44, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (45, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (46, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (47, 2);");
        $this->addSql("INSERT INTO routes_roles(id_route, id_role) VALUES (48, 2);");*/

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
