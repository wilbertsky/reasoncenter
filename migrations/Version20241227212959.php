<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241227212959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, website_url VARCHAR(255) DEFAULT NULL, primary_email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, contact_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_communication_form (id INT AUTO_INCREMENT NOT NULL, partner_id INT NOT NULL, is_event TINYINT(1) DEFAULT NULL, event_start_time DATETIME DEFAULT NULL, event_end_time DATETIME DEFAULT NULL, is_recurring TINYINT(1) DEFAULT NULL, event_name VARCHAR(255) DEFAULT NULL, event_description VARCHAR(255) DEFAULT NULL, event_image VARCHAR(255) DEFAULT NULL, is_published TINYINT(1) NOT NULL, INDEX IDX_ED96F67F9393F8FE (partner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partner_communication_form ADD CONSTRAINT FK_ED96F67F9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('DROP TABLE test');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test (id INT DEFAULT NULL, test_person VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE partner_communication_form DROP FOREIGN KEY FK_ED96F67F9393F8FE');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE partner_communication_form');
    }
}
