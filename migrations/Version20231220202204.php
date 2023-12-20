<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220202204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE release_request_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE response_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE status_post_response (status_post_id INT NOT NULL, response_id INT NOT NULL, PRIMARY KEY(status_post_id, response_id))');
        $this->addSql('CREATE INDEX IDX_AC5ED3CF435974A9 ON status_post_response (status_post_id)');
        $this->addSql('CREATE INDEX IDX_AC5ED3CFFBF32840 ON status_post_response (response_id)');
        $this->addSql('ALTER TABLE status_post_response ADD CONSTRAINT FK_AC5ED3CF435974A9 FOREIGN KEY (status_post_id) REFERENCES status_post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE status_post_response ADD CONSTRAINT FK_AC5ED3CFFBF32840 FOREIGN KEY (response_id) REFERENCES response (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER INDEX idx_106cf6d3b1a3b22e RENAME TO IDX_2DE8C6A3A76ED395');
        $this->addSql('ALTER INDEX idx_106cf6d3d60322ac RENAME TO IDX_2DE8C6A3D60322AC');
        $this->addSql('ALTER TABLE post DROP updated_at');
        $this->addSql('ALTER INDEX idx_cfbe3e114d45bbe RENAME TO IDX_5A8A6C8DF675F31B');
        $this->addSql('ALTER INDEX idx_1e6162a393d2fdc4 RENAME TO IDX_177DDC9AB12A727D');
        $this->addSql('ALTER INDEX idx_1e6162a3915df410 RENAME TO IDX_177DDC9A4B89032C');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT fk_12eaec40126696f1');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT fk_12eaec40493c859e');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT fk_12eaec405999238');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT fk_12eaec40766690ac');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT fk_12eaec40944cb075');
        $this->addSql('DROP INDEX idx_12eaec40944cb075');
        $this->addSql('DROP INDEX idx_12eaec40766690ac');
        $this->addSql('DROP INDEX idx_12eaec405999238');
        $this->addSql('DROP INDEX idx_12eaec40493c859e');
        $this->addSql('DROP INDEX idx_12eaec40126696f1');
        $this->addSql('ALTER TABLE response ADD response_from_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD response_to_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD related_post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD response_on_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response DROP response_from');
        $this->addSql('ALTER TABLE response DROP response_to');
        $this->addSql('ALTER TABLE response DROP related_post');
        $this->addSql('ALTER TABLE response DROP response_on');
        $this->addSql('ALTER TABLE response DROP review');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBD3749F75 FOREIGN KEY (response_from_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB20439135 FOREIGN KEY (response_to_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB7490C989 FOREIGN KEY (related_post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB8FCF50C3 FOREIGN KEY (response_on_id) REFERENCES response (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB3E2E969B FOREIGN KEY (review_id) REFERENCES review (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3E7B0BFBD3749F75 ON response (response_from_id)');
        $this->addSql('CREATE INDEX IDX_3E7B0BFB20439135 ON response (response_to_id)');
        $this->addSql('CREATE INDEX IDX_3E7B0BFB7490C989 ON response (related_post_id)');
        $this->addSql('CREATE INDEX IDX_3E7B0BFB8FCF50C3 ON response (response_on_id)');
        $this->addSql('CREATE INDEX IDX_3E7B0BFB3E2E969B ON response (review_id)');
        $this->addSql('ALTER INDEX idx_387d2901301cd926 RENAME TO IDX_902DC9E170574616');
        $this->addSql('ALTER INDEX idx_387d2901915df410 RENAME TO IDX_902DC9E14B89032C');
        $this->addSql('ALTER INDEX idx_387d2901bd9f2606 RENAME TO IDX_902DC9E16995AC4C');
        $this->addSql('ALTER TABLE review DROP updated_at');
        $this->addSql('ALTER TABLE review ALTER reviewer SET NOT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C64B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_794381C64B89032C ON review (post_id)');
        $this->addSql('ALTER INDEX idx_7b00651c31463a45 RENAME TO IDX_7B00651CCCC0E8A1');
        $this->addSql('ALTER INDEX idx_e0e2734d915df410 RENAME TO IDX_628CC1194B89032C');
        $this->addSql('ALTER INDEX idx_e0e2734d6bf700bd RENAME TO IDX_628CC1196BF700BD');
        $this->addSql('ALTER TABLE version_post DROP updated_at');
        $this->addSql('ALTER TABLE version_post ALTER status SET NOT NULL');
        $this->addSql('ALTER INDEX idx_83c4cba915df410 RENAME TO IDX_EB9A70894B89032C');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE response_request_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE release_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE status_post_response DROP CONSTRAINT FK_AC5ED3CF435974A9');
        $this->addSql('ALTER TABLE status_post_response DROP CONSTRAINT FK_AC5ED3CFFBF32840');
        $this->addSql('DROP TABLE status_post_response');
        $this->addSql('ALTER INDEX idx_628cc1196bf700bd RENAME TO idx_e0e2734d6bf700bd');
        $this->addSql('ALTER INDEX idx_628cc1194b89032c RENAME TO idx_e0e2734d915df410');
        $this->addSql('ALTER INDEX idx_177ddc9a4b89032c RENAME TO idx_1e6162a3915df410');
        $this->addSql('ALTER INDEX idx_177ddc9ab12a727d RENAME TO idx_1e6162a393d2fdc4');
        $this->addSql('ALTER INDEX idx_7b00651cccc0e8a1 RENAME TO idx_7b00651c31463a45');
        $this->addSql('ALTER TABLE version_post ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE version_post ALTER status DROP NOT NULL');
        $this->addSql('ALTER INDEX idx_eb9a70894b89032c RENAME TO idx_83c4cba915df410');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_3E7B0BFBD3749F75');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_3E7B0BFB20439135');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_3E7B0BFB7490C989');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_3E7B0BFB8FCF50C3');
        $this->addSql('ALTER TABLE response DROP CONSTRAINT FK_3E7B0BFB3E2E969B');
        $this->addSql('DROP INDEX IDX_3E7B0BFBD3749F75');
        $this->addSql('DROP INDEX IDX_3E7B0BFB20439135');
        $this->addSql('DROP INDEX IDX_3E7B0BFB7490C989');
        $this->addSql('DROP INDEX IDX_3E7B0BFB8FCF50C3');
        $this->addSql('DROP INDEX IDX_3E7B0BFB3E2E969B');
        $this->addSql('ALTER TABLE response ADD response_from INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD response_to INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD related_post INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD response_on INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD review INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response DROP response_from_id');
        $this->addSql('ALTER TABLE response DROP response_to_id');
        $this->addSql('ALTER TABLE response DROP related_post_id');
        $this->addSql('ALTER TABLE response DROP response_on_id');
        $this->addSql('ALTER TABLE response DROP review_id');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT fk_12eaec40126696f1 FOREIGN KEY (response_from) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT fk_12eaec40493c859e FOREIGN KEY (response_to) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT fk_12eaec405999238 FOREIGN KEY (related_post) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT fk_12eaec40766690ac FOREIGN KEY (response_on) REFERENCES response (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT fk_12eaec40944cb075 FOREIGN KEY (review) REFERENCES review (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_12eaec40944cb075 ON response (review)');
        $this->addSql('CREATE INDEX idx_12eaec40766690ac ON response (response_on)');
        $this->addSql('CREATE INDEX idx_12eaec405999238 ON response (related_post)');
        $this->addSql('CREATE INDEX idx_12eaec40493c859e ON response (response_to)');
        $this->addSql('CREATE INDEX idx_12eaec40126696f1 ON response (response_from)');
        $this->addSql('ALTER TABLE post ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER INDEX idx_5a8a6c8df675f31b RENAME TO idx_cfbe3e114d45bbe');
        $this->addSql('ALTER INDEX idx_902dc9e16995ac4c RENAME TO idx_387d2901bd9f2606');
        $this->addSql('ALTER INDEX idx_902dc9e14b89032c RENAME TO idx_387d2901915df410');
        $this->addSql('ALTER INDEX idx_902dc9e170574616 RENAME TO idx_387d2901301cd926');
        $this->addSql('ALTER INDEX idx_2de8c6a3d60322ac RENAME TO idx_106cf6d3d60322ac');
        $this->addSql('ALTER INDEX idx_2de8c6a3a76ed395 RENAME TO idx_106cf6d3b1a3b22e');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C64B89032C');
        $this->addSql('DROP INDEX IDX_794381C64B89032C');
        $this->addSql('ALTER TABLE review ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE review ALTER reviewer DROP NOT NULL');
    }
}
