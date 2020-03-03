<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122104523 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE IF NOT EXISTS provincia (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS deporte (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(30) NOT NULL, descripcion VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS localidad (id INT AUTO_INCREMENT NOT NULL, provincia_id INT NOT NULL, nombre VARCHAR(40) NOT NULL, INDEX IDX_4F68E0104E7121AF (provincia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
       // $this->addSql('ALTER TABLE localidad ADD CONSTRAINT FK_4F68E0104E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE localidad DROP FOREIGN KEY FK_4F68E0104E7121AF');
        $this->addSql('DROP TABLE provincia');
        $this->addSql('DROP TABLE deporte');
        $this->addSql('DROP TABLE localidad');
    }
}
