<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231101184957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE osoba_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pozadavek_na_recenci_prispevku_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prispevek_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reakce_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recenze_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE status_prispevku_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE verze_prispevku_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vydani_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE osoba (id INT NOT NULL, jmeno VARCHAR(255) NOT NULL, prijmeni VARCHAR(255) NOT NULL, datum_narozeni DATE NOT NULL, email VARCHAR(255) NOT NULL, heslo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE osoba_role (osoba_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(osoba_id, role_id))');
        $this->addSql('CREATE INDEX IDX_106CF6D3B1A3B22E ON osoba_role (osoba_id)');
        $this->addSql('CREATE INDEX IDX_106CF6D3D60322AC ON osoba_role (role_id)');
        $this->addSql('CREATE TABLE pozadavek_na_recenci_prispevku (id INT NOT NULL, recenzent_id INT DEFAULT NULL, prispevek_id INT DEFAULT NULL, redaktor_id INT DEFAULT NULL, start_recenzniho_rizeni TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, konec_recenzniho_rizeni TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_387D2901301CD926 ON pozadavek_na_recenci_prispevku (recenzent_id)');
        $this->addSql('CREATE INDEX IDX_387D2901915DF410 ON pozadavek_na_recenci_prispevku (prispevek_id)');
        $this->addSql('CREATE INDEX IDX_387D2901BD9F2606 ON pozadavek_na_recenci_prispevku (redaktor_id)');
        $this->addSql('CREATE TABLE prispevek (id INT NOT NULL, autor_id INT NOT NULL, datum_vytvoreni TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, tematika VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CFBE3E114D45BBE ON prispevek (autor_id)');
        $this->addSql('CREATE TABLE response (id INT NOT NULL, odkoho_id INT DEFAULT NULL, komu_id INT DEFAULT NULL, odkazovany_prispevek_id INT DEFAULT NULL, odpoved_na_id INT DEFAULT NULL, recenze_id INT DEFAULT NULL, typ VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12EAEC40126696F1 ON response (odkoho_id)');
        $this->addSql('CREATE INDEX IDX_12EAEC40493C859E ON response (komu_id)');
        $this->addSql('CREATE INDEX IDX_12EAEC405999238 ON response (odkazovany_prispevek_id)');
        $this->addSql('CREATE INDEX IDX_12EAEC40766690AC ON response (odpoved_na_id)');
        $this->addSql('CREATE INDEX IDX_12EAEC40944CB075 ON response (recenze_id)');
        $this->addSql('CREATE TABLE recenze (id INT NOT NULL, text VARCHAR(255) NOT NULL, datum_recenze VARCHAR(255) NOT NULL, aktualnost INT NOT NULL, originalita INT NOT NULL, odborna_uroven INT NOT NULL, jazykova_stylisticka_uroven INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, jmeno_role VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE status (id INT NOT NULL, zodpovedna_role_id INT DEFAULT NULL, nazev VARCHAR(255) NOT NULL, popis VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7B00651C31463A45 ON status (zodpovedna_role_id)');
        $this->addSql('CREATE TABLE status_prispevku (id INT NOT NULL, prispevek_id INT NOT NULL, status_id INT NOT NULL, datum_zmeny TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E0E2734D915DF410 ON status_prispevku (prispevek_id)');
        $this->addSql('CREATE INDEX IDX_E0E2734D6BF700BD ON status_prispevku (status_id)');
        $this->addSql('CREATE TABLE verze_prispevku (id INT NOT NULL, prispevek_id INT NOT NULL, file_path VARCHAR(255) NOT NULL, popis VARCHAR(255) NOT NULL, jmeno VARCHAR(255) NOT NULL, datum_verze TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_83C4CBA915DF410 ON verze_prispevku (prispevek_id)');
        $this->addSql('CREATE TABLE vydani (id INT NOT NULL, jmeno VARCHAR(255) NOT NULL, popis VARCHAR(255) NOT NULL, file_path VARCHAR(255) NOT NULL, tematika VARCHAR(255) NOT NULL, kapacita INT NOT NULL, cislo INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE vydani_prispevek (vydani_id INT NOT NULL, prispevek_id INT NOT NULL, PRIMARY KEY(vydani_id, prispevek_id))');
        $this->addSql('CREATE INDEX IDX_1E6162A393D2FDC4 ON vydani_prispevek (vydani_id)');
        $this->addSql('CREATE INDEX IDX_1E6162A3915DF410 ON vydani_prispevek (prispevek_id)');
        $this->addSql('ALTER TABLE osoba_role ADD CONSTRAINT FK_106CF6D3B1A3B22E FOREIGN KEY (osoba_id) REFERENCES osoba (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE osoba_role ADD CONSTRAINT FK_106CF6D3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku ADD CONSTRAINT FK_387D2901301CD926 FOREIGN KEY (recenzent_id) REFERENCES osoba (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku ADD CONSTRAINT FK_387D2901915DF410 FOREIGN KEY (prispevek_id) REFERENCES prispevek (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku ADD CONSTRAINT FK_387D2901BD9F2606 FOREIGN KEY (redaktor_id) REFERENCES osoba (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prispevek ADD CONSTRAINT FK_CFBE3E114D45BBE FOREIGN KEY (autor_id) REFERENCES osoba (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_12EAEC40126696F1 FOREIGN KEY (odkoho_id) REFERENCES osoba (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_12EAEC40493C859E FOREIGN KEY (komu_id) REFERENCES osoba (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_12EAEC405999238 FOREIGN KEY (odkazovany_prispevek_id) REFERENCES prispevek (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_12EAEC40766690AC FOREIGN KEY (odpoved_na_id) REFERENCES response (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_12EAEC40944CB075 FOREIGN KEY (recenze_id) REFERENCES recenze (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651C31463A45 FOREIGN KEY (zodpovedna_role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE status_prispevku ADD CONSTRAINT FK_E0E2734D915DF410 FOREIGN KEY (prispevek_id) REFERENCES prispevek (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE status_prispevku ADD CONSTRAINT FK_E0E2734D6BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE verze_prispevku ADD CONSTRAINT FK_83C4CBA915DF410 FOREIGN KEY (prispevek_id) REFERENCES prispevek (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vydani_prispevek ADD CONSTRAINT FK_1E6162A393D2FDC4 FOREIGN KEY (vydani_id) REFERENCES vydani (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vydani_prispevek ADD CONSTRAINT FK_1E6162A3915DF410 FOREIGN KEY (prispevek_id) REFERENCES prispevek (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE osoba_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pozadavek_na_recenci_prispevku_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prispevek_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reakce_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recenze_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE status_prispevku_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE verze_prispevku_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vydani_id_seq CASCADE');
        $this->addSql('ALTER TABLE osoba_role DROP CONSTRAINT FK_106CF6D3B1A3B22E');
        $this->addSql('ALTER TABLE osoba_role DROP CONSTRAINT FK_106CF6D3D60322AC');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku DROP CONSTRAINT FK_387D2901301CD926');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku DROP CONSTRAINT FK_387D2901915DF410');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku DROP CONSTRAINT FK_387D2901BD9F2606');
        $this->addSql('ALTER TABLE prispevek DROP CONSTRAINT FK_CFBE3E114D45BBE');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_12EAEC40126696F1');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_12EAEC40493C859E');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_12EAEC405999238');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_12EAEC40766690AC');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_12EAEC40944CB075');
        $this->addSql('ALTER TABLE status DROP CONSTRAINT FK_7B00651C31463A45');
        $this->addSql('ALTER TABLE status_prispevku DROP CONSTRAINT FK_E0E2734D915DF410');
        $this->addSql('ALTER TABLE status_prispevku DROP CONSTRAINT FK_E0E2734D6BF700BD');
        $this->addSql('ALTER TABLE verze_prispevku DROP CONSTRAINT FK_83C4CBA915DF410');
        $this->addSql('ALTER TABLE vydani_prispevek DROP CONSTRAINT FK_1E6162A393D2FDC4');
        $this->addSql('ALTER TABLE vydani_prispevek DROP CONSTRAINT FK_1E6162A3915DF410');
        $this->addSql('DROP TABLE osoba');
        $this->addSql('DROP TABLE osoba_role');
        $this->addSql('DROP TABLE pozadavek_na_recenci_prispevku');
        $this->addSql('DROP TABLE prispevek');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP TABLE recenze');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE status_prispevku');
        $this->addSql('DROP TABLE verze_prispevku');
        $this->addSql('DROP TABLE vydani');
        $this->addSql('DROP TABLE vydani_prispevek');
    }
}
