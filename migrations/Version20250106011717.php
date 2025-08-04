<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250106011717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media_object (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partner_communication_form ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partner_communication_form ADD CONSTRAINT FK_ED96F67F3DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
        $this->addSql('CREATE INDEX IDX_ED96F67F3DA5256D ON partner_communication_form (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partner_communication_form DROP FOREIGN KEY FK_ED96F67F3DA5256D');
        $this->addSql('DROP TABLE media_object');
        $this->addSql('DROP INDEX IDX_ED96F67F3DA5256D ON partner_communication_form');
        $this->addSql('ALTER TABLE partner_communication_form DROP image_id');
    }
}
