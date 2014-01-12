<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140112213113 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE trip_country");
        $this->addSql("ALTER TABLE trip ADD country_id INT NOT NULL");
        $this->addSql("ALTER TABLE trip ADD CONSTRAINT FK_D6645A05F92F3E70 FOREIGN KEY (country_id) REFERENCES Country (id)");
        $this->addSql("CREATE INDEX IDX_D6645A05F92F3E70 ON trip (country_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE trip_country (country_id INT NOT NULL, trip_id INT NOT NULL, INDEX IDX_B2136EAFF92F3E70 (country_id), INDEX IDX_B2136EAFA5BC2E0E (trip_id), PRIMARY KEY(country_id, trip_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE trip_country ADD CONSTRAINT FK_B2136EAFA5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)");
        $this->addSql("ALTER TABLE trip_country ADD CONSTRAINT FK_B2136EAFF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)");
        $this->addSql("ALTER TABLE Trip DROP FOREIGN KEY FK_D6645A05F92F3E70");
        $this->addSql("DROP INDEX IDX_D6645A05F92F3E70 ON Trip");
        $this->addSql("ALTER TABLE Trip DROP country_id");
    }
}
