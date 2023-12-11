<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231209220649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE colors (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figures (id INT AUTO_INCREMENT NOT NULL, figure VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profile ADD color_id INT NOT NULL, ADD figure_id INT NOT NULL, DROP color, DROP figure');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F7ADA1FB5 FOREIGN KEY (color_id) REFERENCES colors (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F5C011B5 FOREIGN KEY (figure_id) REFERENCES figures (id)');
        $this->addSql('CREATE INDEX IDX_8157AA0F7ADA1FB5 ON profile (color_id)');
        $this->addSql('CREATE INDEX IDX_8157AA0F5C011B5 ON profile (figure_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F7ADA1FB5');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F5C011B5');
        $this->addSql('DROP TABLE colors');
        $this->addSql('DROP TABLE figures');
        $this->addSql('DROP INDEX IDX_8157AA0F7ADA1FB5 ON profile');
        $this->addSql('DROP INDEX IDX_8157AA0F5C011B5 ON profile');
        $this->addSql('ALTER TABLE profile ADD color LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD figure LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP color_id, DROP figure_id');
    }
}
