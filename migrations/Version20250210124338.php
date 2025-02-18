<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210124338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE convocation CHANGE status status INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE adress adress VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE town town VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club CHANGE image_name image_name VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE convocation CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE adress adress VARCHAR(255) DEFAULT \'NULL\', CHANGE postal_code postal_code VARCHAR(255) DEFAULT \'NULL\', CHANGE town town VARCHAR(255) DEFAULT \'NULL\', CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\'');
    }
}
