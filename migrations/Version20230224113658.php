<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224113658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dogs (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name_dog VARCHAR(255) NOT NULL, photo_dog VARCHAR(255) DEFAULT NULL, race_dog VARCHAR(255) NOT NULL, description_dog VARCHAR(255) NOT NULL, age_dog VARCHAR(255) NOT NULL, INDEX IDX_353BEEB3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupes (id INT AUTO_INCREMENT NOT NULL, name_groupe VARCHAR(255) NOT NULL, area_groupe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name_user VARCHAR(255) NOT NULL, firstname_user VARCHAR(255) NOT NULL, phone_user DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_groupes (users_id INT NOT NULL, groupes_id INT NOT NULL, INDEX IDX_A763121367B3B43D (users_id), INDEX IDX_A7631213305371B (groupes_id), PRIMARY KEY(users_id, groupes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dogs ADD CONSTRAINT FK_353BEEB3A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users_groupes ADD CONSTRAINT FK_A763121367B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_groupes ADD CONSTRAINT FK_A7631213305371B FOREIGN KEY (groupes_id) REFERENCES groupes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15977B92CA');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612977B92CA');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612CBC467DF');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE licencie');
        $this->addSql('DROP TABLE user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE balades DROP FOREIGN KEY FK_3ED88FFA76ED395');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nom_club VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, sport_club VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse_club VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, clubr_id INT DEFAULT NULL, nom_equipe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_2449BA15977B92CA (clubr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE licencie (id INT AUTO_INCREMENT NOT NULL, equiper_id INT DEFAULT NULL, clubr_id INT DEFAULT NULL, nom_licencie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom_licencie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo_licencie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance DATE NOT NULL, INDEX IDX_3B755612977B92CA (clubr_id), INDEX IDX_3B755612CBC467DF (equiper_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15977B92CA FOREIGN KEY (clubr_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612977B92CA FOREIGN KEY (clubr_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612CBC467DF FOREIGN KEY (equiper_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE dogs DROP FOREIGN KEY FK_353BEEB3A76ED395');
        $this->addSql('ALTER TABLE users_groupes DROP FOREIGN KEY FK_A763121367B3B43D');
        $this->addSql('ALTER TABLE users_groupes DROP FOREIGN KEY FK_A7631213305371B');
        $this->addSql('DROP TABLE dogs');
        $this->addSql('DROP TABLE groupes');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_groupes');
    }
}
