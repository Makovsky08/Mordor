<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119124957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER SEQUENCE osoba_id_seq RENAME TO person_id_seq');
        $this->addSql('ALTER SEQUENCE prispevek_id_seq RENAME TO post_id_seq');
        $this->addSql('ALTER SEQUENCE recenze_id_seq RENAME TO review_id_seq');
        $this->addSql('ALTER SEQUENCE vydani_id_seq RENAME TO release_id_seq');
        $this->addSql('ALTER SEQUENCE pozadavek_na_recenci_prispevku_id_seq RENAME TO release_request_id_seq');
        $this->addSql('ALTER SEQUENCE reakce_id_seq RENAME TO response_id_seq');
        $this->addSql('ALTER SEQUENCE status_prispevku_id_seq RENAME TO status_post_id_seq');
        $this->addSql('ALTER SEQUENCE verze_prispevku_id_seq RENAME TO version_post_id_seq');

        $this->addSql('ALTER TABLE osoba RENAME CONSTRAINT osoba_pkey TO person_pkey');
        $this->addSql('ALTER TABLE osoba RENAME COLUMN jmeno TO name');
        $this->addSql('ALTER TABLE osoba RENAME COLUMN prijmeni TO surname');
        $this->addSql('ALTER TABLE osoba RENAME COLUMN datum_narozeni TO birthdate');
        $this->addSql('ALTER TABLE osoba RENAME COLUMN heslo TO password');
        $this->addSql('ALTER TABLE osoba RENAME TO person');

        $this->addSql('ALTER TABLE Prispevek RENAME CONSTRAINT prispevek_pkey TO post_pkey');
        $this->addSql('ALTER TABLE Prispevek RENAME COLUMN autor_id TO author_id');
        $this->addSql('ALTER TABLE Prispevek RENAME COLUMN datum_vytvoreni TO created_at');
        $this->addSql('ALTER TABLE Prispevek ADD COLUMN updated_at timestamp');
        $this->addSql('ALTER TABLE Prispevek RENAME COLUMN tematika TO topics');
        $this->addSql('ALTER TABLE Prispevek RENAME TO post');

        $this->addSql('ALTER TABLE osoba_role RENAME CONSTRAINT osoba_role_pkey TO user_role_pkey');
        $this->addSql('ALTER TABLE osoba_role RENAME COLUMN osoba_id TO user_id');
        $this->addSql('ALTER TABLE osoba_role RENAME TO user_role');

        $this->addSql('ALTER TABLE role RENAME COLUMN jmeno_role TO role_title');

        $this->addSql('ALTER TABLE Recenze RENAME CONSTRAINT recenze_pkey TO review_pkey');
        $this->addSql('ALTER TABLE Recenze RENAME COLUMN datum_recenze TO created_at');
        $this->addSql('ALTER TABLE Recenze ADD COLUMN updated_at timestamp');
        $this->addSql('ALTER TABLE Recenze ADD COLUMN reviewer int');
        $this->addSql('ALTER TABLE Recenze ADD COLUMN post_id int');
        $this->addSql('ALTER TABLE Recenze RENAME COLUMN aktualnost TO topicality');
        $this->addSql('ALTER TABLE Recenze RENAME COLUMN originalita TO originality');
        $this->addSql('ALTER TABLE Recenze RENAME COLUMN odborna_uroven TO expertise_level');
        $this->addSql('ALTER TABLE Recenze RENAME COLUMN jazykova_stylisticka_uroven TO stylistics_level');
        $this->addSql('ALTER TABLE Recenze RENAME TO review');

        $this->addSql('ALTER TABLE Vydani RENAME CONSTRAINT vydani_pkey TO release_pkey');
        $this->addSql('ALTER TABLE Vydani RENAME COLUMN jmeno TO title');
        $this->addSql('ALTER TABLE Vydani RENAME COLUMN popis TO description');
        $this->addSql('ALTER TABLE Vydani RENAME COLUMN Tematika TO topics');
        $this->addSql('ALTER TABLE Vydani RENAME COLUMN Kapacita TO capacity');
        $this->addSql('ALTER TABLE Vydani RENAME COLUMN cislo TO number');
        $this->addSql('ALTER TABLE Vydani RENAME TO Release');

        $this->addSql('ALTER TABLE vydani_prispevek RENAME CONSTRAINT vydani_prispevek_pkey TO release_post_pkey');
        $this->addSql('ALTER TABLE vydani_prispevek RENAME COLUMN vydani_id TO release_id');
        $this->addSql('ALTER TABLE vydani_prispevek RENAME COLUMN prispevek_id TO post_id');
        $this->addSql('ALTER TABLE vydani_prispevek RENAME TO release_post');

        $this->addSql('ALTER TABLE verze_prispevku RENAME CONSTRAINT verze_prispevku_pkey TO version_post_pkey');
        $this->addSql('ALTER TABLE verze_prispevku RENAME COLUMN prispevek_id TO post_id');
        $this->addSql('ALTER TABLE verze_prispevku RENAME COLUMN popis TO description');
        $this->addSql('ALTER TABLE verze_prispevku RENAME COLUMN jmeno TO title');
        $this->addSql('ALTER TABLE verze_prispevku RENAME COLUMN datum_verze TO updated_at');
        $this->addSql('ALTER TABLE verze_prispevku RENAME TO version_post');

        $this->addSql('ALTER TABLE status RENAME COLUMN zodpovedna_role_id TO responsible_role_id');
        $this->addSql('ALTER TABLE status RENAME COLUMN nazev TO title');
        $this->addSql('ALTER TABLE status RENAME COLUMN popis TO description');

        $this->addSql('ALTER TABLE status_prispevku RENAME CONSTRAINT status_prispevku_pkey TO status_post_pkey');
        $this->addSql('ALTER TABLE status_prispevku RENAME COLUMN prispevek_id TO post_id');
        $this->addSql('ALTER TABLE status_prispevku RENAME COLUMN datum_zmeny TO updated_at');
        $this->addSql('ALTER TABLE status_prispevku RENAME TO status_post');

        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku RENAME CONSTRAINT pozadavek_na_recenci_prispevku_pkey TO response_request_pkey');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku RENAME COLUMN recenzent_id TO reviewer_id');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku RENAME COLUMN prispevek_id TO post_id');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku RENAME COLUMN redaktor_id TO editor_id');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku RENAME COLUMN start_recenzniho_rizeni TO start_review');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku RENAME COLUMN konec_recenzniho_rizeni TO end_review');
        $this->addSql('ALTER TABLE pozadavek_na_recenci_prispevku RENAME TO response_request');

        $this->addSql('ALTER TABLE reakce RENAME CONSTRAINT reakce_pkey TO response_pkey');
        $this->addSql('ALTER TABLE reakce RENAME COLUMN odkoho_id TO response_from');
        $this->addSql('ALTER TABLE reakce RENAME COLUMN komu_id TO response_to');
        $this->addSql('ALTER TABLE reakce RENAME COLUMN odkazovany_prispevek_id TO related_post');
        $this->addSql('ALTER TABLE reakce RENAME COLUMN odpoved_na_id TO response_on');
        $this->addSql('ALTER TABLE reakce RENAME COLUMN recenze_id TO review');
        $this->addSql('ALTER TABLE reakce RENAME COLUMN typ TO type');
        $this->addSql('ALTER TABLE reakce RENAME TO response');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER SEQUENCE person_id_seq RENAME TO osoba_id_seq');
        $this->addSql('ALTER SEQUENCE post_id_seq RENAME TO prispevek_id_seq');
        $this->addSql('ALTER SEQUENCE review_id_seq RENAME TO recenze_id_seq');
        $this->addSql('ALTER SEQUENCE release_id_seq RENAME TO vydani_id_seq');
        $this->addSql('ALTER SEQUENCE release_request_id_seq RENAME TO pozadavek_na_recenci_prispevku_id_seq');
        $this->addSql('ALTER SEQUENCE response_id_seq RENAME TO reakce_id_seq');
        $this->addSql('ALTER SEQUENCE status_post_id_seq RENAME TO status_prispevku_id_seq');
        $this->addSql('ALTER SEQUENCE version_post_id_seq RENAME TO verze_prispevku_id_seq');

        $this->addSql('ALTER TABLE person RENAME CONSTRAINT person_pkey TO osoba_pkey');
        $this->addSql('ALTER TABLE person RENAME COLUMN name TO jmeno');
        $this->addSql('ALTER TABLE person RENAME COLUMN surname TO prijmeni');
        $this->addSql('ALTER TABLE person RENAME COLUMN birthdate TO datum_narozeni');
        $this->addSql('ALTER TABLE person RENAME COLUMN password TO heslo');
        $this->addSql('ALTER TABLE person RENAME TO osoba');

        $this->addSql('ALTER TABLE post RENAME CONSTRAINT post_pkey TO prispevek_pkey');
        $this->addSql('ALTER TABLE post RENAME COLUMN author_id TO autor_id');
        $this->addSql('ALTER TABLE post RENAME COLUMN created_at TO datum_vytvoreni');
        $this->addSql('ALTER TABLE post DROP COLUMN updated_at');
        $this->addSql('ALTER TABLE post RENAME COLUMN topics TO tematika');
        $this->addSql('ALTER TABLE post RENAME TO Prispevek');

        $this->addSql('ALTER TABLE user_role RENAME CONSTRAINT user_role_pkey TO osoba_role_pkey');
        $this->addSql('ALTER TABLE user_role RENAME COLUMN user_id TO osoba_id');
        $this->addSql('ALTER TABLE user_role RENAME TO osoba_role');

        $this->addSql('ALTER TABLE role RENAME COLUMN role_title TO jmeno_role');

        $this->addSql('ALTER TABLE review RENAME CONSTRAINT review_pkey TO recenze_pkey');
        $this->addSql('ALTER TABLE review RENAME COLUMN created_at TO datum_recenze');
        $this->addSql('ALTER TABLE review DROP COLUMN updated_at');
        $this->addSql('ALTER TABLE review DROP COLUMN reviewer');
        $this->addSql('ALTER TABLE review DROP COLUMN post_id');
        $this->addSql('ALTER TABLE review RENAME COLUMN topicality TO aktualnost');
        $this->addSql('ALTER TABLE review RENAME COLUMN originality TO originalita');
        $this->addSql('ALTER TABLE review RENAME COLUMN expertise_level TO odborna_uroven');
        $this->addSql('ALTER TABLE review RENAME COLUMN stylistics_level TO jazykova_stylisticka_uroven');
        $this->addSql('ALTER TABLE review RENAME TO Recenze');

        $this->addSql('ALTER TABLE vydani RENAME CONSTRAINT release_pkey TO vydani_pkey');
        $this->addSql('ALTER TABLE vydani RENAME COLUMN title TO jmeno');
        $this->addSql('ALTER TABLE vydani RENAME COLUMN description TO popis');
        $this->addSql('ALTER TABLE vydani RENAME COLUMN Tematika TO topics');
        $this->addSql('ALTER TABLE vydani RENAME COLUMN Kapacita TO capacity');
        $this->addSql('ALTER TABLE vydani RENAME COLUMN cislo TO number');
        $this->addSql('ALTER TABLE vydani RENAME TO Release');

        $this->addSql('ALTER TABLE vydani_prispevek RENAME CONSTRAINT release_post_pkey TO vydani_prispevku_pkey');
        $this->addSql('ALTER TABLE vydani_prispevek RENAME COLUMN release_id TO vydani_id');
        $this->addSql('ALTER TABLE vydani_prispevek RENAME COLUMN post_id TO prispevek_id');
        $this->addSql('ALTER TABLE vydani_prispevek RENAME TO release_post');

        $this->addSql('ALTER TABLE verze_prispevku RENAME CONSTRAINT version_post_pkey TO verze_prispevku_pkey');
        $this->addSql('ALTER TABLE verze_prispevku RENAME COLUMN post_id TO prispevek_id');
        $this->addSql('ALTER TABLE verze_prispevku RENAME COLUMN description TO popis');
        $this->addSql('ALTER TABLE verze_prispevku RENAME COLUMN title TO jmeno');
        $this->addSql('ALTER TABLE verze_prispevku RENAME COLUMN updated_at TO datum_verze');
        $this->addSql('ALTER TABLE verze_prispevku RENAME TO version_post');

        $this->addSql('ALTER TABLE status RENAME COLUMN responsible_role_id TO zodpovedna_role_id');
        $this->addSql('ALTER TABLE status RENAME COLUMN title TO nazev');
        $this->addSql('ALTER TABLE status RENAME COLUMN description TO popis');

        $this->addSql('ALTER TABLE status_post RENAME CONSTRAINT status_post_pkey TO status_prispevku_pkey');
        $this->addSql('ALTER TABLE status_post RENAME COLUMN post_id TO prispevek_id');
        $this->addSql('ALTER TABLE status_post RENAME COLUMN updated_at TO datum_zmeny');
        $this->addSql('ALTER TABLE status_post RENAME TO status_prispeveku');

        $this->addSql('ALTER TABLE response_request RENAME CONSTRAINT response_request_pkey TO pozadavek_na_recenci_prispevku_pkey');
        $this->addSql('ALTER TABLE response_request RENAME COLUMN reviewer_id TO recenzent_id');
        $this->addSql('ALTER TABLE response_request RENAME COLUMN post_id TO prispevek_id');
        $this->addSql('ALTER TABLE response_request RENAME COLUMN editor_id TO redaktor_id');
        $this->addSql('ALTER TABLE response_request RENAME COLUMN start_review TO start_recenzniho_rizeni');
        $this->addSql('ALTER TABLE response_request RENAME COLUMN end_review TO konec_recenzniho_rizeni');
        $this->addSql('ALTER TABLE response_request RENAME TO pozadavek_na_recenci_prispevku');

        $this->addSql('ALTER TABLE response RENAME CONSTRAINT response_pkey TO reakce_pkey');
        $this->addSql('ALTER TABLE response RENAME COLUMN response_from TO odkoho_id');
    }
}
