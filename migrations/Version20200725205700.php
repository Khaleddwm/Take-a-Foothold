<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200725205700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD creation_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE performance ADD creation_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE player ADD creation_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE video ADD creation_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP creation_date');
        $this->addSql('ALTER TABLE performance DROP creation_date');
        $this->addSql('ALTER TABLE player DROP creation_date');
        $this->addSql('ALTER TABLE video DROP creation_date');
    }
}
