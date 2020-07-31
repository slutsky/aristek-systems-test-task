<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200801150644 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE contact (id SERIAL NOT NULL, project_id INT DEFAULT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, phone VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C62E638166D1F9C ON contact (project_id)');
        $this->addSql('CREATE TABLE project (id SERIAL NOT NULL, name VARCHAR(50) NOT NULL, code VARCHAR(10) NOT NULL, url VARCHAR(255) NOT NULL, budget INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE contact DROP CONSTRAINT FK_4C62E638166D1F9C');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE project');
    }
}
