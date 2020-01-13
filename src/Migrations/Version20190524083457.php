<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524083457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appareil (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, prix_unit INT NOT NULL, qte_vendue INT NOT NULL, date_sortie DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fabricant (id INT AUTO_INCREMENT NOT NULL, appareil_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, pays_origine VARCHAR(255) NOT NULL, INDEX IDX_D740A269BF6A0032 (appareil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE systeme (id INT AUTO_INCREMENT NOT NULL, appareil_id INT DEFAULT NULL, famille VARCHAR(255) NOT NULL, editeur VARCHAR(255) NOT NULL, INDEX IDX_95796DE3BF6A0032 (appareil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fabricant ADD CONSTRAINT FK_D740A269BF6A0032 FOREIGN KEY (appareil_id) REFERENCES appareil (id)');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE3BF6A0032 FOREIGN KEY (appareil_id) REFERENCES appareil (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fabricant DROP FOREIGN KEY FK_D740A269BF6A0032');
        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE3BF6A0032');
        $this->addSql('DROP TABLE appareil');
        $this->addSql('DROP TABLE fabricant');
        $this->addSql('DROP TABLE systeme');
    }
}
