<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200527193347 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE figures CHANGE image_top image_top VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE figure_id figure_id INT DEFAULT NULL, CHANGE image_figure image_figure VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD verif_password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE video CHANGE figure_id figure_id INT DEFAULT NULL, CHANGE video_name video_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE figures CHANGE image_top image_top VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE image CHANGE figure_id figure_id INT DEFAULT NULL, CHANGE image_figure image_figure VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users DROP verif_password');
        $this->addSql('ALTER TABLE video CHANGE figure_id figure_id INT DEFAULT NULL, CHANGE video_name video_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
