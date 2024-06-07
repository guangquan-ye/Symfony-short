<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607131653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `comment` (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', id_user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', id_post_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', data JSON NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9474526C79F37AE5 (id_user_id), INDEX IDX_9474526C9514AA5C (id_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `comment` ADD CONSTRAINT FK_9474526C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `comment` ADD CONSTRAINT FK_9474526C9514AA5C FOREIGN KEY (id_post_id) REFERENCES `post` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `comment` DROP FOREIGN KEY FK_9474526C79F37AE5');
        $this->addSql('ALTER TABLE `comment` DROP FOREIGN KEY FK_9474526C9514AA5C');
        $this->addSql('DROP TABLE `comment`');
    }
}
