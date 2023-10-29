<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231029150030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE osoba_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE osoba (id INT NOT NULL, jmeno VARCHAR(255) NOT NULL, prijmeni VARCHAR(255) NOT NULL, datum_narozeni DATE NOT NULL, email VARCHAR(255) NOT NULL, heslo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE osoba_role (osoba_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(osoba_id, role_id))');
        $this->addSql('CREATE INDEX IDX_106CF6D3B1A3B22E ON osoba_role (osoba_id)');
        $this->addSql('CREATE INDEX IDX_106CF6D3D60322AC ON osoba_role (role_id)');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, jmeno_role VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE osoba_role ADD CONSTRAINT FK_106CF6D3B1A3B22E FOREIGN KEY (osoba_id) REFERENCES osoba (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE osoba_role ADD CONSTRAINT FK_106CF6D3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE osoba_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('ALTER TABLE osoba_role DROP CONSTRAINT FK_106CF6D3B1A3B22E');
        $this->addSql('ALTER TABLE osoba_role DROP CONSTRAINT FK_106CF6D3D60322AC');
        $this->addSql('DROP TABLE osoba');
        $this->addSql('DROP TABLE osoba_role');
        $this->addSql('DROP TABLE role');
    }
}
