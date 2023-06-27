<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230627085547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15977B92CA');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612CBC467DF');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612977B92CA');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE licencie');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE activites ADD emoji VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nom_club VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, sport_club VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse_club VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, clubr_id INT DEFAULT NULL, nom_equipe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_2449BA15977B92CA (clubr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE licencie (id INT AUTO_INCREMENT NOT NULL, equiper_id INT DEFAULT NULL, clubr_id INT DEFAULT NULL, nom_licencie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom_licencie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo_licencie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance DATE NOT NULL, INDEX IDX_3B755612CBC467DF (equiper_id), INDEX IDX_3B755612977B92CA (clubr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15977B92CA FOREIGN KEY (clubr_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612CBC467DF FOREIGN KEY (equiper_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612977B92CA FOREIGN KEY (clubr_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE activites DROP emoji');
    }
}
