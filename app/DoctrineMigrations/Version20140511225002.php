<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140511225002 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Author ADD updated_at DATETIME DEFAULT NULL, CHANGE createdat created_at DATETIME NOT NULL");
        $this->addSql("ALTER TABLE Post ADD updated_at DATETIME DEFAULT NULL, CHANGE createdat created_at DATETIME NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Author DROP updated_at, CHANGE created_at createdAt DATETIME NOT NULL");
        $this->addSql("ALTER TABLE Post DROP updated_at, CHANGE created_at createdAt DATETIME NOT NULL");
    }
}
