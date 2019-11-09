<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191109191611 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, adressedomicile VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, descriptionclient VARCHAR(255) DEFAULT NULL, offre VARCHAR(255) DEFAULT NULL, admin VARCHAR(255) DEFAULT NULL, exterieur VARCHAR(255) DEFAULT NULL, solde DOUBLE PRECISION DEFAULT NULL, noteclient INT DEFAULT NULL, notedriver INT DEFAULT NULL, categorieclient VARCHAR(255) DEFAULT NULL, categoriedriver VARCHAR(255) DEFAULT NULL, dateinsertion VARCHAR(255) DEFAULT NULL, dateinsertiondriver VARCHAR(255) DEFAULT NULL, datenaissance VARCHAR(255) DEFAULT NULL, typeclient VARCHAR(255) DEFAULT NULL, societe VARCHAR(255) DEFAULT NULL, adressesociete VARCHAR(255) DEFAULT NULL, telephonesociete VARCHAR(255) DEFAULT NULL, typesociete VARCHAR(255) DEFAULT NULL, registrecommerce VARCHAR(255) DEFAULT NULL, emailsociete VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, isdriver VARCHAR(255) DEFAULT NULL, siren VARCHAR(255) DEFAULT NULL, datepermis VARCHAR(255) DEFAULT NULL, typepermis VARCHAR(255) DEFAULT NULL, disponible VARCHAR(255) DEFAULT NULL, confirmationdriver VARCHAR(255) DEFAULT NULL, comptestripe VARCHAR(255) DEFAULT NULL, conduite VARCHAR(255) DEFAULT NULL, ponctualite VARCHAR(255) DEFAULT NULL, attention VARCHAR(255) DEFAULT NULL, personneabord VARCHAR(255) DEFAULT NULL, gradechauffeur VARCHAR(255) DEFAULT NULL, adressefacturation VARCHAR(255) DEFAULT NULL, taillesociete VARCHAR(255) DEFAULT NULL, activitesociete VARCHAR(255) DEFAULT NULL, nombrevoiture INT DEFAULT NULL, typevoiture VARCHAR(255) DEFAULT NULL, modele VARCHAR(255) DEFAULT NULL, marque VARCHAR(255) DEFAULT NULL, immatriculation VARCHAR(255) DEFAULT NULL, gestionnaire VARCHAR(255) DEFAULT NULL, emailgestionnaire VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
    }
}
