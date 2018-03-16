<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180315201637 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO menu( 
            id_menu, id_menu_padre, nombre, orden, path, parametro)
        VALUES 
            (12, 1, 'USUARIOS', 110, 'users_index', null);");

        $this->addSql("UPDATE menu SET  
            nombre = 'ROLES', orden = 120
        WHERE 
            (id_menu = 10);");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
