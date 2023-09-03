<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version1_0_1 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE charge_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE charge_line_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE charge (id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN charge.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE charge_line (id INT NOT NULL, charge_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_99D7D92955284914 ON charge_line (charge_id)');
        $this->addSql('ALTER TABLE charge_line ADD CONSTRAINT FK_99D7D92955284914 FOREIGN KEY (charge_id) REFERENCES charge (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE charge_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE charge_line_id_seq CASCADE');
        $this->addSql('ALTER TABLE charge_line DROP CONSTRAINT FK_99D7D92955284914');
        $this->addSql('DROP TABLE charge');
        $this->addSql('DROP TABLE charge_line');
    }
}
