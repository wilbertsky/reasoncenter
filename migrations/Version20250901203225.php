<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250901203225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Updates the isbn to varchar(10) not null, and the synopsis to a LONGTEXT type.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book CHANGE copyright copyright INT DEFAULT NULL, CHANGE synopsis synopsis LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book CHANGE copyright copyright DATE DEFAULT NULL, CHANGE synopsis synopsis VARCHAR(255) DEFAULT NULL');
    }
}
