<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301133337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE food_plan_meal (food_plan_id INT NOT NULL, meal_id INT NOT NULL, INDEX IDX_13DA2FF5A706DEA3 (food_plan_id), INDEX IDX_13DA2FF5639666D6 (meal_id), PRIMARY KEY(food_plan_id, meal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_food (meal_id INT NOT NULL, food_id INT NOT NULL, INDEX IDX_CEE6FA03639666D6 (meal_id), INDEX IDX_CEE6FA03BA8E87C4 (food_id), PRIMARY KEY(meal_id, food_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_utensil (recipe_id INT NOT NULL, utensil_id INT NOT NULL, INDEX IDX_D3CC32FC59D8A214 (recipe_id), INDEX IDX_D3CC32FCEC4313DE (utensil_id), PRIMARY KEY(recipe_id, utensil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE food_plan_meal ADD CONSTRAINT FK_13DA2FF5A706DEA3 FOREIGN KEY (food_plan_id) REFERENCES food_plan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE food_plan_meal ADD CONSTRAINT FK_13DA2FF5639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_food ADD CONSTRAINT FK_CEE6FA03639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_food ADD CONSTRAINT FK_CEE6FA03BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_utensil ADD CONSTRAINT FK_D3CC32FC59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_utensil ADD CONSTRAINT FK_D3CC32FCEC4313DE FOREIGN KEY (utensil_id) REFERENCES utensil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE food_plan ADD period_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE food_plan ADD CONSTRAINT FK_687DF3ACEC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_687DF3ACEC8B7ADE ON food_plan (period_id)');
        $this->addSql('ALTER TABLE meal ADD recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_9EF68E9C59D8A214 ON meal (recipe_id)');
        $this->addSql('ALTER TABLE step ADD recipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_43B9FE3C59D8A214 ON step (recipe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE food_plan_meal');
        $this->addSql('DROP TABLE meal_food');
        $this->addSql('DROP TABLE recipe_utensil');
        $this->addSql('ALTER TABLE food_plan DROP FOREIGN KEY FK_687DF3ACEC8B7ADE');
        $this->addSql('DROP INDEX UNIQ_687DF3ACEC8B7ADE ON food_plan');
        $this->addSql('ALTER TABLE food_plan DROP period_id');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C59D8A214');
        $this->addSql('DROP INDEX IDX_9EF68E9C59D8A214 ON meal');
        $this->addSql('ALTER TABLE meal DROP recipe_id');
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3C59D8A214');
        $this->addSql('DROP INDEX IDX_43B9FE3C59D8A214 ON step');
        $this->addSql('ALTER TABLE step DROP recipe_id');
        $this->addSql('ALTER TABLE `user` CHANGE email email VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE pseudo pseudo VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE phone phone VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`');
    }
}
