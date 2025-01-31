<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250131221150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE age_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, town VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, is_coach_of_id INT DEFAULT NULL, user_id INT NOT NULL, INDEX IDX_3F596DCC9FE9AD23 (is_coach_of_id), UNIQUE INDEX UNIQ_3F596DCCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE convocation (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, event_id INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_C03B3F5F99E6F5DF (player_id), INDEX IDX_C03B3F5F71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_type_id INT NOT NULL, team_id INT NOT NULL, visitor_team_id INT DEFAULT NULL, stadium_id INT NOT NULL, season_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_3BAE0AA7401B253C (event_type_id), INDEX IDX_3BAE0AA7296CD8AE (team_id), INDEX IDX_3BAE0AA7EB7F4866 (visitor_team_id), INDEX IDX_3BAE0AA77E860E36 (stadium_id), INDEX IDX_3BAE0AA74EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE goal (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, event_id INT NOT NULL, minute_goal INT NOT NULL, INDEX IDX_FCDCEB2E99E6F5DF (player_id), INDEX IDX_FCDCEB2E71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, plays_in_id INT DEFAULT NULL, user_id INT NOT NULL, INDEX IDX_98197A6550FAE107 (plays_in_id), UNIQUE INDEX UNIQ_98197A65A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, event_id INT NOT NULL, on_time TINYINT(1) NOT NULL, INDEX IDX_6977C7A599E6F5DF (player_id), INDEX IDX_6977C7A571F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stadium (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, town VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, age_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C4E0A61FE1F4383B (age_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, adress VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, town VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, INDEX IDX_8D93D649D60322AC (role_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_is_parent_of (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, child_id INT NOT NULL, INDEX IDX_4D1A1DB7A76ED395 (user_id), INDEX IDX_4D1A1DB7DD62C21B (child_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visitor_team (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, age_category_id INT NOT NULL, INDEX IDX_3A6C6D1761190A32 (club_id), INDEX IDX_3A6C6D17E1F4383B (age_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC9FE9AD23 FOREIGN KEY (is_coach_of_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5F99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7401B253C FOREIGN KEY (event_type_id) REFERENCES event_type (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7EB7F4866 FOREIGN KEY (visitor_team_id) REFERENCES visitor_team (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA77E860E36 FOREIGN KEY (stadium_id) REFERENCES stadium (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6550FAE107 FOREIGN KEY (plays_in_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A571F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FE1F4383B FOREIGN KEY (age_category_id) REFERENCES age_category (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE user_is_parent_of ADD CONSTRAINT FK_4D1A1DB7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_is_parent_of ADD CONSTRAINT FK_4D1A1DB7DD62C21B FOREIGN KEY (child_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE visitor_team ADD CONSTRAINT FK_3A6C6D1761190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE visitor_team ADD CONSTRAINT FK_3A6C6D17E1F4383B FOREIGN KEY (age_category_id) REFERENCES age_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC9FE9AD23');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCCA76ED395');
        $this->addSql('ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5F99E6F5DF');
        $this->addSql('ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5F71F7E88B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7401B253C');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7296CD8AE');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7EB7F4866');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA77E860E36');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74EC001D1');
        $this->addSql('ALTER TABLE goal DROP FOREIGN KEY FK_FCDCEB2E99E6F5DF');
        $this->addSql('ALTER TABLE goal DROP FOREIGN KEY FK_FCDCEB2E71F7E88B');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6550FAE107');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65A76ED395');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A599E6F5DF');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A571F7E88B');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FE1F4383B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE user_is_parent_of DROP FOREIGN KEY FK_4D1A1DB7A76ED395');
        $this->addSql('ALTER TABLE user_is_parent_of DROP FOREIGN KEY FK_4D1A1DB7DD62C21B');
        $this->addSql('ALTER TABLE visitor_team DROP FOREIGN KEY FK_3A6C6D1761190A32');
        $this->addSql('ALTER TABLE visitor_team DROP FOREIGN KEY FK_3A6C6D17E1F4383B');
        $this->addSql('DROP TABLE age_category');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE convocation');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_type');
        $this->addSql('DROP TABLE goal');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE presence');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE stadium');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_is_parent_of');
        $this->addSql('DROP TABLE visitor_team');
    }
}
