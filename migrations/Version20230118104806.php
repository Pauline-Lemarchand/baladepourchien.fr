<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118104806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_groupes (users_id INT NOT NULL, groupes_id INT NOT NULL, INDEX IDX_A763121367B3B43D (users_id), INDEX IDX_A7631213305371B (groupes_id), PRIMARY KEY(users_id, groupes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_groupes ADD CONSTRAINT FK_A763121367B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_groupes ADD CONSTRAINT FK_A7631213305371B FOREIGN KEY (groupes_id) REFERENCES groupes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE balades ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE balades ADD CONSTRAINT FK_3ED88FFA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_3ED88FFA76ED395 ON balades (user_id)');
        $this->addSql('ALTER TABLE dogs ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dogs ADD CONSTRAINT FK_353BEEB3A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_353BEEB3A76ED395 ON dogs (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_groupes DROP FOREIGN KEY FK_A763121367B3B43D');
        $this->addSql('ALTER TABLE users_groupes DROP FOREIGN KEY FK_A7631213305371B');
        $this->addSql('DROP TABLE users_groupes');
        $this->addSql('ALTER TABLE balades DROP FOREIGN KEY FK_3ED88FFA76ED395');
        $this->addSql('DROP INDEX IDX_3ED88FFA76ED395 ON balades');
        $this->addSql('ALTER TABLE balades DROP user_id');
        $this->addSql('ALTER TABLE dogs DROP FOREIGN KEY FK_353BEEB3A76ED395');
        $this->addSql('DROP INDEX IDX_353BEEB3A76ED395 ON dogs');
        $this->addSql('ALTER TABLE dogs DROP user_id');
    }
}
