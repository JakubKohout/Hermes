<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140112093413 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE type CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE catering CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE country CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE category CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE office CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE contract CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE customer CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE participant CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE employee CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE role CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE transport CHANGE id id INT AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE trip CHANGE id id INT AUTO_INCREMENT NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Category CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Catering CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Contract CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Country CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Customer CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Employee CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Office CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Participant CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Role CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Transport CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Trip CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE Type CHANGE id id INT NOT NULL");
    }
}
