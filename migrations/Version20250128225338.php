<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250128225338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach ADD is_coach_of_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC9FE9AD23 FOREIGN KEY (is_coach_of_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC9FE9AD23 ON coach (is_coach_of_id)');
        $this->addSql('ALTER TABLE event ADD event_type_id INT NOT NULL, ADD team_id INT NOT NULL, ADD visitor_team_id INT NOT NULL, ADD stadium_id INT NOT NULL, ADD season_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7401B253C FOREIGN KEY (event_type_id) REFERENCES event_type (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7EB7F4866 FOREIGN KEY (visitor_team_id) REFERENCES visitor_team (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA77E860E36 FOREIGN KEY (stadium_id) REFERENCES stadium (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7401B253C ON event (event_type_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7296CD8AE ON event (team_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7EB7F4866 ON event (visitor_team_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA77E860E36 ON event (stadium_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA74EC001D1 ON event (season_id)');
        $this->addSql('ALTER TABLE goal ADD player_id INT NOT NULL, ADD event_id INT NOT NULL');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_FCDCEB2E99E6F5DF ON goal (player_id)');
        $this->addSql('CREATE INDEX IDX_FCDCEB2E71F7E88B ON goal (event_id)');
        $this->addSql('ALTER TABLE player ADD plays_in_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6550FAE107 FOREIGN KEY (plays_in_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_98197A6550FAE107 ON player (plays_in_id)');
        $this->addSql('ALTER TABLE presence ADD player_id INT NOT NULL, ADD event_id INT NOT NULL');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A571F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_6977C7A599E6F5DF ON presence (player_id)');
        $this->addSql('CREATE INDEX IDX_6977C7A571F7E88B ON presence (event_id)');
        $this->addSql('ALTER TABLE team ADD age_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FE1F4383B FOREIGN KEY (age_category_id) REFERENCES age_category (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61FE1F4383B ON team (age_category_id)');
        $this->addSql('ALTER TABLE user CHANGE adress adress VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE town town VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_is_parent_of ADD user_id INT NOT NULL, ADD child_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_is_parent_of ADD CONSTRAINT FK_4D1A1DB7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_is_parent_of ADD CONSTRAINT FK_4D1A1DB7DD62C21B FOREIGN KEY (child_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4D1A1DB7A76ED395 ON user_is_parent_of (user_id)');
        $this->addSql('CREATE INDEX IDX_4D1A1DB7DD62C21B ON user_is_parent_of (child_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC9FE9AD23');
        $this->addSql('DROP INDEX IDX_3F596DCC9FE9AD23 ON coach');
        $this->addSql('ALTER TABLE coach DROP is_coach_of_id');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7401B253C');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7296CD8AE');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7EB7F4866');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA77E860E36');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74EC001D1');
        $this->addSql('DROP INDEX IDX_3BAE0AA7401B253C ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA7296CD8AE ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA7EB7F4866 ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA77E860E36 ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA74EC001D1 ON event');
        $this->addSql('ALTER TABLE event DROP event_type_id, DROP team_id, DROP visitor_team_id, DROP stadium_id, DROP season_id');
        $this->addSql('ALTER TABLE goal DROP FOREIGN KEY FK_FCDCEB2E99E6F5DF');
        $this->addSql('ALTER TABLE goal DROP FOREIGN KEY FK_FCDCEB2E71F7E88B');
        $this->addSql('DROP INDEX IDX_FCDCEB2E99E6F5DF ON goal');
        $this->addSql('DROP INDEX IDX_FCDCEB2E71F7E88B ON goal');
        $this->addSql('ALTER TABLE goal DROP player_id, DROP event_id');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6550FAE107');
        $this->addSql('DROP INDEX IDX_98197A6550FAE107 ON player');
        $this->addSql('ALTER TABLE player DROP plays_in_id');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A599E6F5DF');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A571F7E88B');
        $this->addSql('DROP INDEX IDX_6977C7A599E6F5DF ON presence');
        $this->addSql('DROP INDEX IDX_6977C7A571F7E88B ON presence');
        $this->addSql('ALTER TABLE presence DROP player_id, DROP event_id');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FE1F4383B');
        $this->addSql('DROP INDEX IDX_C4E0A61FE1F4383B ON team');
        $this->addSql('ALTER TABLE team DROP age_category_id');
        $this->addSql('ALTER TABLE user CHANGE adress adress VARCHAR(255) DEFAULT \'NULL\', CHANGE postal_code postal_code VARCHAR(255) DEFAULT \'NULL\', CHANGE town town VARCHAR(255) DEFAULT \'NULL\', CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user_is_parent_of DROP FOREIGN KEY FK_4D1A1DB7A76ED395');
        $this->addSql('ALTER TABLE user_is_parent_of DROP FOREIGN KEY FK_4D1A1DB7DD62C21B');
        $this->addSql('DROP INDEX IDX_4D1A1DB7A76ED395 ON user_is_parent_of');
        $this->addSql('DROP INDEX IDX_4D1A1DB7DD62C21B ON user_is_parent_of');
        $this->addSql('ALTER TABLE user_is_parent_of DROP user_id, DROP child_id');
    }
}
