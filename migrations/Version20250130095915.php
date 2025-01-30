<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130095915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, town VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE adress adress VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE town town VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE visitor_team ADD club_id INT NOT NULL, ADD age_category_id INT NOT NULL, DROP name, DROP adress, DROP postal_code, DROP town, DROP image_name');
        $this->addSql('ALTER TABLE visitor_team ADD CONSTRAINT FK_3A6C6D1761190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE visitor_team ADD CONSTRAINT FK_3A6C6D17E1F4383B FOREIGN KEY (age_category_id) REFERENCES age_category (id)');
        $this->addSql('CREATE INDEX IDX_3A6C6D1761190A32 ON visitor_team (club_id)');
        $this->addSql('CREATE INDEX IDX_3A6C6D17E1F4383B ON visitor_team (age_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visitor_team DROP FOREIGN KEY FK_3A6C6D1761190A32');
        $this->addSql('DROP TABLE club');
        $this->addSql('ALTER TABLE user CHANGE adress adress VARCHAR(255) DEFAULT \'NULL\', CHANGE postal_code postal_code VARCHAR(255) DEFAULT \'NULL\', CHANGE town town VARCHAR(255) DEFAULT \'NULL\', CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE visitor_team DROP FOREIGN KEY FK_3A6C6D17E1F4383B');
        $this->addSql('DROP INDEX IDX_3A6C6D1761190A32 ON visitor_team');
        $this->addSql('DROP INDEX IDX_3A6C6D17E1F4383B ON visitor_team');
        $this->addSql('ALTER TABLE visitor_team ADD name VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD postal_code VARCHAR(255) NOT NULL, ADD town VARCHAR(255) NOT NULL, ADD image_name VARCHAR(255) DEFAULT \'NULL\', DROP club_id, DROP age_category_id');
    }
}
