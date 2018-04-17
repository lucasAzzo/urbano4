<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180417133152 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE file_structure_shipper ADD id_file_structure INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_structure_shipper ADD id_shipper INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_structure_shipper ADD id_producto INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_structure_shipper ADD id_estado INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_structure_shipper ADD id_usuario INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B4DC68359A FOREIGN KEY (id_file_structure) REFERENCES file_structure_std (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B477BB638D FOREIGN KEY (id_shipper) REFERENCES shipper (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B4F760EA80 FOREIGN KEY (id_producto) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B46A540E FOREIGN KEY (id_estado) REFERENCES estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_shipper ADD CONSTRAINT FK_3106A1B4FCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3106A1B4DC68359A ON file_structure_shipper (id_file_structure)');
        $this->addSql('CREATE INDEX IDX_3106A1B477BB638D ON file_structure_shipper (id_shipper)');
        $this->addSql('CREATE INDEX IDX_3106A1B4F760EA80 ON file_structure_shipper (id_producto)');
        $this->addSql('CREATE INDEX IDX_3106A1B46A540E ON file_structure_shipper (id_estado)');
        $this->addSql('CREATE INDEX IDX_3106A1B4FCF8192D ON file_structure_shipper (id_usuario)');
        $this->addSql('ALTER TABLE file_structure_std ADD id_estado INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_structure_std ADD id_usuario INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_structure_std ADD CONSTRAINT FK_B42FE4166A540E FOREIGN KEY (id_estado) REFERENCES estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_structure_std ADD CONSTRAINT FK_B42FE416FCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B42FE4166A540E ON file_structure_std (id_estado)');
        $this->addSql('CREATE INDEX IDX_B42FE416FCF8192D ON file_structure_std (id_usuario)');
        $this->addSql('ALTER TABLE legajo ADD id_persona INT DEFAULT NULL');
        $this->addSql('ALTER TABLE legajo ADD id_estado INT DEFAULT NULL');
        $this->addSql('ALTER TABLE legajo ADD CONSTRAINT FK_32DD07F68F781FEB FOREIGN KEY (id_persona) REFERENCES persona (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE legajo ADD CONSTRAINT FK_32DD07F66A540E FOREIGN KEY (id_estado) REFERENCES estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_32DD07F68F781FEB ON legajo (id_persona)');
        $this->addSql('CREATE INDEX IDX_32DD07F66A540E ON legajo (id_estado)');
        $this->addSql('ALTER TABLE original_file ADD id_shipper INT DEFAULT NULL');
        $this->addSql('ALTER TABLE original_file ADD id_usuario INT DEFAULT NULL');
        $this->addSql('ALTER TABLE original_file ADD CONSTRAINT FK_86EA5D2677BB638D FOREIGN KEY (id_shipper) REFERENCES shipper (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE original_file ADD CONSTRAINT FK_86EA5D26FCF8192D FOREIGN KEY (id_usuario) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_86EA5D2677BB638D ON original_file (id_shipper)');
        $this->addSql('CREATE INDEX IDX_86EA5D26FCF8192D ON original_file (id_usuario)');
        $this->addSql('ALTER TABLE persona DROP CONSTRAINT fk_51e5b69bbf396750');
        $this->addSql('ALTER TABLE persona ADD id_estado INT DEFAULT NULL');
        $this->addSql('ALTER TABLE persona ADD CONSTRAINT FK_51E5B69B6A540E FOREIGN KEY (id_estado) REFERENCES estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_51E5B69B6A540E ON persona (id_estado)');
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
        $this->addSql('ALTER TABLE legajo DROP CONSTRAINT FK_32DD07F68F781FEB');
        $this->addSql('ALTER TABLE legajo DROP CONSTRAINT FK_32DD07F66A540E');
        $this->addSql('DROP INDEX IDX_32DD07F68F781FEB');
        $this->addSql('DROP INDEX IDX_32DD07F66A540E');
        $this->addSql('ALTER TABLE legajo DROP id_persona');
        $this->addSql('ALTER TABLE legajo DROP id_estado');
        $this->addSql('ALTER TABLE file_structure_std DROP CONSTRAINT FK_B42FE4166A540E');
        $this->addSql('ALTER TABLE file_structure_std DROP CONSTRAINT FK_B42FE416FCF8192D');
        $this->addSql('DROP INDEX IDX_B42FE4166A540E');
        $this->addSql('DROP INDEX IDX_B42FE416FCF8192D');
        $this->addSql('ALTER TABLE file_structure_std DROP id_estado');
        $this->addSql('ALTER TABLE file_structure_std DROP id_usuario');
        $this->addSql('ALTER TABLE file_structure_shipper DROP CONSTRAINT FK_3106A1B4DC68359A');
        $this->addSql('ALTER TABLE file_structure_shipper DROP CONSTRAINT FK_3106A1B477BB638D');
        $this->addSql('ALTER TABLE file_structure_shipper DROP CONSTRAINT FK_3106A1B4F760EA80');
        $this->addSql('ALTER TABLE file_structure_shipper DROP CONSTRAINT FK_3106A1B46A540E');
        $this->addSql('ALTER TABLE file_structure_shipper DROP CONSTRAINT FK_3106A1B4FCF8192D');
        $this->addSql('DROP INDEX IDX_3106A1B4DC68359A');
        $this->addSql('DROP INDEX IDX_3106A1B477BB638D');
        $this->addSql('DROP INDEX IDX_3106A1B4F760EA80');
        $this->addSql('DROP INDEX IDX_3106A1B46A540E');
        $this->addSql('DROP INDEX IDX_3106A1B4FCF8192D');
        $this->addSql('ALTER TABLE file_structure_shipper DROP id_file_structure');
        $this->addSql('ALTER TABLE file_structure_shipper DROP id_shipper');
        $this->addSql('ALTER TABLE file_structure_shipper DROP id_producto');
        $this->addSql('ALTER TABLE file_structure_shipper DROP id_estado');
        $this->addSql('ALTER TABLE file_structure_shipper DROP id_usuario');
        $this->addSql('ALTER TABLE upload ALTER upload_timestamp SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE original_file DROP CONSTRAINT FK_86EA5D2677BB638D');
        $this->addSql('ALTER TABLE original_file DROP CONSTRAINT FK_86EA5D26FCF8192D');
        $this->addSql('DROP INDEX IDX_86EA5D2677BB638D');
        $this->addSql('DROP INDEX IDX_86EA5D26FCF8192D');
        $this->addSql('ALTER TABLE original_file DROP id_shipper');
        $this->addSql('ALTER TABLE original_file DROP id_usuario');
        $this->addSql('ALTER TABLE persona DROP CONSTRAINT FK_51E5B69B6A540E');
        $this->addSql('DROP INDEX IDX_51E5B69B6A540E');
        $this->addSql('ALTER TABLE persona DROP id_estado');
        $this->addSql('ALTER TABLE persona ADD CONSTRAINT fk_51e5b69bbf396750 FOREIGN KEY (id) REFERENCES estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
