<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200724200130 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, saison INT NOT NULL, assist INT NOT NULL, goal INT NOT NULL, time_played INT NOT NULL, INDEX IDX_82D7968199E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, poster_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, nationality VARCHAR(255) NOT NULL, current_team VARCHAR(255) NOT NULL, best_foot VARCHAR(255) NOT NULL, size INT NOT NULL, weight INT NOT NULL, price INT DEFAULT NULL, position VARCHAR(255) NOT NULL, INDEX IDX_98197A655BB66C05 (poster_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_image (player_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_7A4F7F1999E6F5DF (player_id), INDEX IDX_7A4F7F193DA5256D (image_id), PRIMARY KEY(player_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_video (player_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_C3B5A16A99E6F5DF (player_id), INDEX IDX_C3B5A16A29C1004E (video_id), PRIMARY KEY(player_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A655BB66C05 FOREIGN KEY (poster_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE player_image ADD CONSTRAINT FK_7A4F7F1999E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_image ADD CONSTRAINT FK_7A4F7F193DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_video ADD CONSTRAINT FK_C3B5A16A99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_video ADD CONSTRAINT FK_C3B5A16A29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A655BB66C05');
        $this->addSql('ALTER TABLE player_image DROP FOREIGN KEY FK_7A4F7F193DA5256D');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968199E6F5DF');
        $this->addSql('ALTER TABLE player_image DROP FOREIGN KEY FK_7A4F7F1999E6F5DF');
        $this->addSql('ALTER TABLE player_video DROP FOREIGN KEY FK_C3B5A16A99E6F5DF');
        $this->addSql('ALTER TABLE player_video DROP FOREIGN KEY FK_C3B5A16A29C1004E');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_image');
        $this->addSql('DROP TABLE player_video');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
    }
}
