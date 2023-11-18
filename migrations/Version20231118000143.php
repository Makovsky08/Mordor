<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231118000143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE osoba_role DROP CONSTRAINT FK_106CF6D3B1A3B22E');
        $this->addSql('ALTER TABLE osoba_role DROP CONSTRAINT FK_106CF6D3D60322AC');
        $this->addSql('ALTER TABLE osoba_role ADD CONSTRAINT FK_106CF6D3B1A3B22E FOREIGN KEY (osoba_id) REFERENCES osoba (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE osoba_role ADD CONSTRAINT FK_106CF6D3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX uniq_7b00651c31463a45');
        $this->addSql('ALTER TABLE status ALTER zodpovedna_role_id SET NOT NULL');
        $this->addSql('CREATE INDEX IDX_7B00651C31463A45 ON status (zodpovedna_role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_7B00651C31463A45');
        $this->addSql('ALTER TABLE status ALTER zodpovedna_role_id DROP NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_7b00651c31463a45 ON status (zodpovedna_role_id)');
        $this->addSql('ALTER TABLE osoba_role DROP CONSTRAINT fk_106cf6d3b1a3b22e');
        $this->addSql('ALTER TABLE osoba_role DROP CONSTRAINT fk_106cf6d3d60322ac');
        $this->addSql('ALTER TABLE osoba_role ADD CONSTRAINT fk_106cf6d3b1a3b22e FOREIGN KEY (osoba_id) REFERENCES osoba (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE osoba_role ADD CONSTRAINT fk_106cf6d3d60322ac FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
