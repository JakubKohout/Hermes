<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140112101758 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Trip_Country (country_id INT NOT NULL, trip_id INT NOT NULL, INDEX IDX_B2136EAFF92F3E70 (country_id), INDEX IDX_B2136EAFA5BC2E0E (trip_id), PRIMARY KEY(country_id, trip_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE contract_participant (contracts_id INT NOT NULL, participants_id INT NOT NULL, INDEX IDX_9534B2DC24584564 (contracts_id), INDEX IDX_9534B2DC838709D5 (participants_id), PRIMARY KEY(contracts_id, participants_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE employee_role (employees_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_E2B0C02D8520A30B (employees_id), INDEX IDX_E2B0C02DD60322AC (role_id), PRIMARY KEY(employees_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE Trip_Country ADD CONSTRAINT FK_B2136EAFF92F3E70 FOREIGN KEY (country_id) REFERENCES Country (id)");
        $this->addSql("ALTER TABLE Trip_Country ADD CONSTRAINT FK_B2136EAFA5BC2E0E FOREIGN KEY (trip_id) REFERENCES Trip (id)");
        $this->addSql("ALTER TABLE contract_participant ADD CONSTRAINT FK_9534B2DC24584564 FOREIGN KEY (contracts_id) REFERENCES Contract (id)");
        $this->addSql("ALTER TABLE contract_participant ADD CONSTRAINT FK_9534B2DC838709D5 FOREIGN KEY (participants_id) REFERENCES Participant (id)");
        $this->addSql("ALTER TABLE employee_role ADD CONSTRAINT FK_E2B0C02D8520A30B FOREIGN KEY (employees_id) REFERENCES Employee (id)");
        $this->addSql("ALTER TABLE employee_role ADD CONSTRAINT FK_E2B0C02DD60322AC FOREIGN KEY (role_id) REFERENCES Role (id)");
        $this->addSql("DROP TABLE contractparticipant");
        $this->addSql("DROP TABLE employeerole");
        $this->addSql("DROP TABLE tripcountry");
        $this->addSql("ALTER TABLE contract ADD signed DATETIME NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE contractparticipant (contracts_id INT NOT NULL, participants_id INT NOT NULL, INDEX IDX_D8DC38324584564 (contracts_id), INDEX IDX_D8DC383838709D5 (participants_id), PRIMARY KEY(contracts_id, participants_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE employeerole (employees_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_AB8491EB8520A30B (employees_id), INDEX IDX_AB8491EBD60322AC (role_id), PRIMARY KEY(employees_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE tripcountry (country_id INT NOT NULL, trip_id INT NOT NULL, INDEX IDX_C6EC304F92F3E70 (country_id), INDEX IDX_C6EC304A5BC2E0E (trip_id), PRIMARY KEY(country_id, trip_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE contractparticipant ADD CONSTRAINT FK_D8DC383838709D5 FOREIGN KEY (participants_id) REFERENCES participant (id)");
        $this->addSql("ALTER TABLE contractparticipant ADD CONSTRAINT FK_D8DC38324584564 FOREIGN KEY (contracts_id) REFERENCES contract (id)");
        $this->addSql("ALTER TABLE employeerole ADD CONSTRAINT FK_AB8491EBD60322AC FOREIGN KEY (role_id) REFERENCES role (id)");
        $this->addSql("ALTER TABLE employeerole ADD CONSTRAINT FK_AB8491EB8520A30B FOREIGN KEY (employees_id) REFERENCES employee (id)");
        $this->addSql("ALTER TABLE tripcountry ADD CONSTRAINT FK_C6EC304A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)");
        $this->addSql("ALTER TABLE tripcountry ADD CONSTRAINT FK_C6EC304F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)");
        $this->addSql("DROP TABLE Trip_Country");
        $this->addSql("DROP TABLE contract_participant");
        $this->addSql("DROP TABLE employee_role");
        $this->addSql("ALTER TABLE Contract DROP signed");
    }
}
