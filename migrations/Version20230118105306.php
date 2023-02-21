<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118105306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE balades_activites (balades_id INT NOT NULL, activites_id INT NOT NULL, INDEX IDX_2E00A0C6F5387D58 (balades_id), INDEX IDX_2E00A0C65B8C31B7 (activites_id), PRIMARY KEY(balades_id, activites_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE balades_dangers (balades_id INT NOT NULL, dangers_id INT NOT NULL, INDEX IDX_3F576E5AF5387D58 (balades_id), INDEX IDX_3F576E5AC04FA76F (dangers_id), PRIMARY KEY(balades_id, dangers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE balades_activites ADD CONSTRAINT FK_2E00A0C6F5387D58 FOREIGN KEY (balades_id) REFERENCES balades (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE balades_activites ADD CONSTRAINT FK_2E00A0C65B8C31B7 FOREIGN KEY (activites_id) REFERENCES activites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE balades_dangers ADD CONSTRAINT FK_3F576E5AF5387D58 FOREIGN KEY (balades_id) REFERENCES balades (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE balades_dangers ADD CONSTRAINT FK_3F576E5AC04FA76F FOREIGN KEY (dangers_id) REFERENCES dangers (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE balades_activites DROP FOREIGN KEY FK_2E00A0C6F5387D58');
        $this->addSql('ALTER TABLE balades_activites DROP FOREIGN KEY FK_2E00A0C65B8C31B7');
        $this->addSql('ALTER TABLE balades_dangers DROP FOREIGN KEY FK_3F576E5AF5387D58');
        $this->addSql('ALTER TABLE balades_dangers DROP FOREIGN KEY FK_3F576E5AC04FA76F');
        $this->addSql('DROP TABLE balades_activites');
        $this->addSql('DROP TABLE balades_dangers');
    }
}
