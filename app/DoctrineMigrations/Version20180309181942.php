<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180309181942 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO pais VALUES
              (1,'Argentina'),
              (2,'Chile'),
              (3,'Ecuador'),
              (4,'Perú');
              ");
        $this->addSql("INSERT INTO region VALUES
              (1,'Norte'),
              (2,'Sur'),
              (3,'Este'),
              (4,'Oeste');
              ");

        $this->addSql("INSERT INTO provincia VALUES
              (1,'Buenos Aires'),
              (2,'Rosario'),
              (3,'Córdoba'),
              (4,'Mendoza');
              ");

        $this->addSql("INSERT INTO ciudad VALUES
              (1,'Buenos Aires'),
              (2,'Rosario'),
              (3,'Córdoba'),
              (4,'Mendoza');
              ");

        $this->addSql("INSERT INTO zona VALUES
              (1,'Sur'),
              (2,'Norte'),
              (3,'Este'),
              (4,'Oeste');
              ");

        $this->addSql("INSERT INTO sucursal VALUES
              (1,'Sucursal 1', 1),
              (2,'Sucursal 2', 2),
              (3,'Sucursal 3', 2 ),
              (4,'Sucursal 4', 3);
              ");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
