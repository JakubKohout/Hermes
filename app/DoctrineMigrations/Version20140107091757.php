<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140107091757 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Type (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Catering (id INT NOT NULL, trip_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_8008C0B6A5BC2E0E (trip_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Country (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE TripCountry (country_id INT NOT NULL, trip_id INT NOT NULL, INDEX IDX_C6EC304F92F3E70 (country_id), INDEX IDX_C6EC304A5BC2E0E (trip_id), PRIMARY KEY(country_id, trip_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Category (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Service (id INT AUTO_INCREMENT NOT NULL, trip_id INT NOT NULL, participant_id INT NOT NULL, catering_id INT NOT NULL, transports_id INT NOT NULL, accommodations_id INT NOT NULL, INDEX IDX_2E20A34EA5BC2E0E (trip_id), INDEX IDX_2E20A34E9D1C3019 (participant_id), INDEX IDX_2E20A34EE42F97B9 (catering_id), INDEX IDX_2E20A34E518E99D9 (transports_id), INDEX IDX_2E20A34E22B35BA (accommodations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Accommodation (id INT AUTO_INCREMENT NOT NULL, trip_id INT NOT NULL, INDEX IDX_9E461FE7A5BC2E0E (trip_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Contract (id INT NOT NULL, office_id INT NOT NULL, employee_id INT NOT NULL, trip_id INT NOT NULL, customers_id INT NOT NULL, INDEX IDX_10F94A0FFFA0C224 (office_id), INDEX IDX_10F94A0F8C03F15C (employee_id), INDEX IDX_10F94A0FA5BC2E0E (trip_id), INDEX IDX_10F94A0FC3568B40 (customers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE ContractParticipant (contracts_id INT NOT NULL, participants_id INT NOT NULL, INDEX IDX_D8DC38324584564 (contracts_id), INDEX IDX_D8DC383838709D5 (participants_id), PRIMARY KEY(contracts_id, participants_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Customer (id INT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, personal_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Participant (id INT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, personal_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Office (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Employee (id INT NOT NULL, office_id INT NOT NULL, INDEX IDX_A4E917F7FFA0C224 (office_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE EmployeeRole (employees_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_AB8491EB8520A30B (employees_id), INDEX IDX_AB8491EBD60322AC (role_id), PRIMARY KEY(employees_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Role (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Transport (id INT NOT NULL, trip_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, type LONGTEXT DEFAULT NULL COMMENT '(DC2Type:simple_array)', INDEX IDX_E45AA38DA5BC2E0E (trip_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Trip (id INT NOT NULL, type_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_D6645A05C54C8C93 (type_id), INDEX IDX_D6645A0512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE Catering ADD CONSTRAINT FK_8008C0B6A5BC2E0E FOREIGN KEY (trip_id) REFERENCES Trip (id)");
        $this->addSql("ALTER TABLE TripCountry ADD CONSTRAINT FK_C6EC304F92F3E70 FOREIGN KEY (country_id) REFERENCES Country (id)");
        $this->addSql("ALTER TABLE TripCountry ADD CONSTRAINT FK_C6EC304A5BC2E0E FOREIGN KEY (trip_id) REFERENCES Trip (id)");
        $this->addSql("ALTER TABLE Service ADD CONSTRAINT FK_2E20A34EA5BC2E0E FOREIGN KEY (trip_id) REFERENCES Trip (id)");
        $this->addSql("ALTER TABLE Service ADD CONSTRAINT FK_2E20A34E9D1C3019 FOREIGN KEY (participant_id) REFERENCES Participant (id)");
        $this->addSql("ALTER TABLE Service ADD CONSTRAINT FK_2E20A34EE42F97B9 FOREIGN KEY (catering_id) REFERENCES Catering (id)");
        $this->addSql("ALTER TABLE Service ADD CONSTRAINT FK_2E20A34E518E99D9 FOREIGN KEY (transports_id) REFERENCES Transport (id)");
        $this->addSql("ALTER TABLE Service ADD CONSTRAINT FK_2E20A34E22B35BA FOREIGN KEY (accommodations_id) REFERENCES Accommodation (id)");
        $this->addSql("ALTER TABLE Accommodation ADD CONSTRAINT FK_9E461FE7A5BC2E0E FOREIGN KEY (trip_id) REFERENCES Trip (id)");
        $this->addSql("ALTER TABLE Contract ADD CONSTRAINT FK_10F94A0FFFA0C224 FOREIGN KEY (office_id) REFERENCES Office (id)");
        $this->addSql("ALTER TABLE Contract ADD CONSTRAINT FK_10F94A0F8C03F15C FOREIGN KEY (employee_id) REFERENCES Employee (id)");
        $this->addSql("ALTER TABLE Contract ADD CONSTRAINT FK_10F94A0FA5BC2E0E FOREIGN KEY (trip_id) REFERENCES Trip (id)");
        $this->addSql("ALTER TABLE Contract ADD CONSTRAINT FK_10F94A0FC3568B40 FOREIGN KEY (customers_id) REFERENCES Customer (id)");
        $this->addSql("ALTER TABLE ContractParticipant ADD CONSTRAINT FK_D8DC38324584564 FOREIGN KEY (contracts_id) REFERENCES Contract (id)");
        $this->addSql("ALTER TABLE ContractParticipant ADD CONSTRAINT FK_D8DC383838709D5 FOREIGN KEY (participants_id) REFERENCES Participant (id)");
        $this->addSql("ALTER TABLE Employee ADD CONSTRAINT FK_A4E917F7FFA0C224 FOREIGN KEY (office_id) REFERENCES Office (id)");
        $this->addSql("ALTER TABLE EmployeeRole ADD CONSTRAINT FK_AB8491EB8520A30B FOREIGN KEY (employees_id) REFERENCES Employee (id)");
        $this->addSql("ALTER TABLE EmployeeRole ADD CONSTRAINT FK_AB8491EBD60322AC FOREIGN KEY (role_id) REFERENCES Role (id)");
        $this->addSql("ALTER TABLE Transport ADD CONSTRAINT FK_E45AA38DA5BC2E0E FOREIGN KEY (trip_id) REFERENCES Trip (id)");
        $this->addSql("ALTER TABLE Trip ADD CONSTRAINT FK_D6645A05C54C8C93 FOREIGN KEY (type_id) REFERENCES Type (id)");
        $this->addSql("ALTER TABLE Trip ADD CONSTRAINT FK_D6645A0512469DE2 FOREIGN KEY (category_id) REFERENCES Category (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Trip DROP FOREIGN KEY FK_D6645A05C54C8C93");
        $this->addSql("ALTER TABLE Service DROP FOREIGN KEY FK_2E20A34EE42F97B9");
        $this->addSql("ALTER TABLE TripCountry DROP FOREIGN KEY FK_C6EC304F92F3E70");
        $this->addSql("ALTER TABLE Trip DROP FOREIGN KEY FK_D6645A0512469DE2");
        $this->addSql("ALTER TABLE Service DROP FOREIGN KEY FK_2E20A34E22B35BA");
        $this->addSql("ALTER TABLE ContractParticipant DROP FOREIGN KEY FK_D8DC38324584564");
        $this->addSql("ALTER TABLE Contract DROP FOREIGN KEY FK_10F94A0FC3568B40");
        $this->addSql("ALTER TABLE Service DROP FOREIGN KEY FK_2E20A34E9D1C3019");
        $this->addSql("ALTER TABLE ContractParticipant DROP FOREIGN KEY FK_D8DC383838709D5");
        $this->addSql("ALTER TABLE Contract DROP FOREIGN KEY FK_10F94A0FFFA0C224");
        $this->addSql("ALTER TABLE Employee DROP FOREIGN KEY FK_A4E917F7FFA0C224");
        $this->addSql("ALTER TABLE Contract DROP FOREIGN KEY FK_10F94A0F8C03F15C");
        $this->addSql("ALTER TABLE EmployeeRole DROP FOREIGN KEY FK_AB8491EB8520A30B");
        $this->addSql("ALTER TABLE EmployeeRole DROP FOREIGN KEY FK_AB8491EBD60322AC");
        $this->addSql("ALTER TABLE Service DROP FOREIGN KEY FK_2E20A34E518E99D9");
        $this->addSql("ALTER TABLE Catering DROP FOREIGN KEY FK_8008C0B6A5BC2E0E");
        $this->addSql("ALTER TABLE TripCountry DROP FOREIGN KEY FK_C6EC304A5BC2E0E");
        $this->addSql("ALTER TABLE Service DROP FOREIGN KEY FK_2E20A34EA5BC2E0E");
        $this->addSql("ALTER TABLE Accommodation DROP FOREIGN KEY FK_9E461FE7A5BC2E0E");
        $this->addSql("ALTER TABLE Contract DROP FOREIGN KEY FK_10F94A0FA5BC2E0E");
        $this->addSql("ALTER TABLE Transport DROP FOREIGN KEY FK_E45AA38DA5BC2E0E");
        $this->addSql("DROP TABLE Type");
        $this->addSql("DROP TABLE Catering");
        $this->addSql("DROP TABLE Country");
        $this->addSql("DROP TABLE TripCountry");
        $this->addSql("DROP TABLE Category");
        $this->addSql("DROP TABLE Service");
        $this->addSql("DROP TABLE Accommodation");
        $this->addSql("DROP TABLE Contract");
        $this->addSql("DROP TABLE ContractParticipant");
        $this->addSql("DROP TABLE Customer");
        $this->addSql("DROP TABLE Participant");
        $this->addSql("DROP TABLE Office");
        $this->addSql("DROP TABLE Employee");
        $this->addSql("DROP TABLE EmployeeRole");
        $this->addSql("DROP TABLE Role");
        $this->addSql("DROP TABLE Transport");
        $this->addSql("DROP TABLE Trip");
    }
}
