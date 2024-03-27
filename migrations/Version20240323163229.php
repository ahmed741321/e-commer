<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240323163229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, state_id INT NOT NULL, state_code VARCHAR(4) NOT NULL, state_name VARCHAR(100) NOT NULL, country_name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE countries ADD cities_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE countries ADD CONSTRAINT FK_5D66EBADCAC75398 FOREIGN KEY (cities_id) REFERENCES cities (id)');
        $this->addSql('CREATE INDEX IDX_5D66EBADCAC75398 ON countries (cities_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE countries DROP FOREIGN KEY FK_5D66EBADCAC75398');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP INDEX IDX_5D66EBADCAC75398 ON countries');
        $this->addSql('ALTER TABLE countries DROP cities_id');
    }
}
