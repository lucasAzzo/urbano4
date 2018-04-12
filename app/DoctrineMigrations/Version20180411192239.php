<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180411192239 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE file_structure_shipper (id SERIAL NOT NULL, id_file_structure_std INT DEFAULT NULL, id_shipper INT DEFAULT NULL, id_producto INT DEFAULT NULL, id_estado INT DEFAULT NULL, id_usuario INT DEFAULT NULL, nombre_campo_shipper VARCHAR(255) NOT NULL, orden INT NOT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3106A1B4370D56B9 ON file_structure_shipper (id_file_structure_std)');
        $this->addSql('CREATE INDEX IDX_3106A1B477BB638D ON file_structure_shipper (id_shipper)');
        $this->addSql('CREATE INDEX IDX_3106A1B4F760EA80 ON file_structure_shipper (id_producto)');
        $this->addSql('CREATE INDEX IDX_3106A1B46A540E ON file_structure_shipper (id_estado)');
        $this->addSql('CREATE INDEX IDX_3106A1B4FCF8192D ON file_structure_shipper (id_usuario)');
        $this->addSql('CREATE TABLE file_structure_std (id SERIAL NOT NULL, id_estado INT DEFAULT NULL, id_usuario INT DEFAULT NULL, nombre_campo VARCHAR(255) NOT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B42FE4166A540E ON file_structure_std (id_estado)');
        $this->addSql('CREATE INDEX IDX_B42FE416FCF8192D ON file_structure_std (id_usuario)');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B4370D56B9 FOREIGN KEY (id_file_structure_std) REFERENCES file_structure_std (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B477BB638D FOREIGN KEY (id_shipper) REFERENCES shipper (id_shipper) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B4F760EA80 FOREIGN KEY (id_producto) REFERENCES producto (id_producto) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B46A540E FOREIGN KEY (id_estado) REFERENCES estado (id_estado) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B4FCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_std ADD CONSTRAINT FK_B42FE4166A540E FOREIGN KEY (id_estado) REFERENCES estado (id_estado) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_std ADD CONSTRAINT FK_B42FE416FCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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
        $this->addSql('ALTER TABLE file_structure_shipper DROP CONSTRAINT FK_3106A1B4370D56B9');
        $this->addSql('DROP TABLE file_structure_shipper');
        $this->addSql('DROP TABLE file_structure_std');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
        $this->addSql('DROP INDEX routes_roles_pkey');
        $this->addSql('ALTER TABLE routes_roles ADD PRIMARY KEY (id_role, id_route)');
        $this->addSql('ALTER TABLE route ALTER parametro TYPE TEXT');
        $this->addSql('ALTER TABLE route ALTER parametro DROP DEFAULT');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion TYPE TEXT');
        $this->addSql('ALTER TABLE shipper_original ALTER descripcion DROP DEFAULT');
    }
}
