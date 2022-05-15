<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301130048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE food ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F7A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_D43829F7A76ED395 ON food (user_id)');
        $this->addSql('ALTER TABLE food_plan ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE food_plan ADD CONSTRAINT FK_687DF3ACA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_687DF3ACA76ED395 ON food_plan (user_id)');
        $this->addSql('ALTER TABLE meal ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_9EF68E9CA76ED395 ON meal (user_id)');
        $this->addSql('ALTER TABLE progression ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B25073A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_D5B25073A76ED395 ON progression (user_id)');
        $this->addSql('ALTER TABLE user ADD activity_id INT DEFAULT NULL, ADD objective_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64981C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64973484933 FOREIGN KEY (objective_id) REFERENCES objective (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64981C06096 ON user (activity_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64973484933 ON user (objective_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F7A76ED395');
        $this->addSql('DROP INDEX IDX_D43829F7A76ED395 ON food');
        $this->addSql('ALTER TABLE food DROP user_id');
        $this->addSql('ALTER TABLE food_plan DROP FOREIGN KEY FK_687DF3ACA76ED395');
        $this->addSql('DROP INDEX IDX_687DF3ACA76ED395 ON food_plan');
        $this->addSql('ALTER TABLE food_plan DROP user_id');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9CA76ED395');
        $this->addSql('DROP INDEX IDX_9EF68E9CA76ED395 ON meal');
        $this->addSql('ALTER TABLE meal DROP user_id');
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B25073A76ED395');
        $this->addSql('DROP INDEX IDX_D5B25073A76ED395 ON progression');
        $this->addSql('ALTER TABLE progression DROP user_id');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64981C06096');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64973484933');
        $this->addSql('DROP INDEX IDX_8D93D64981C06096 ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D64973484933 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP activity_id, DROP objective_id, CHANGE email email VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE pseudo pseudo VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE phone phone VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`');
    }
}
