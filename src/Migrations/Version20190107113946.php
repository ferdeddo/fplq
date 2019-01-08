<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190107113946 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, membre_id INT NOT NULL, montant INT NOT NULL, date_enregistrement DATETIME NOT NULL, etat VARCHAR(50) NOT NULL, INDEX IDX_6EEAA67D6A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, quantite INT NOT NULL, prix INT NOT NULL, UNIQUE INDEX UNIQ_4BCD5F682EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_commande_menu (details_commande_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_5EF664AEE99004AB (details_commande_id), INDEX IDX_5EF664AECCD7E912 (menu_id), PRIMARY KEY(details_commande_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, membre_id INT NOT NULL, adresse VARCHAR(80) NOT NULL, complement VARCHAR(80) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(50) NOT NULL, INDEX IDX_A60C9F1F6A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, mdp VARCHAR(64) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(80) NOT NULL, photo VARCHAR(180) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, nom VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, photo VARCHAR(180) DEFAULT NULL, INDEX IDX_7D053A93B1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, adresse VARCHAR(80) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(50) NOT NULL, horaires VARCHAR(80) NOT NULL, commande_min INT NOT NULL, prix_livraison INT NOT NULL, type VARCHAR(50) NOT NULL, photo VARCHAR(180) NOT NULL, note INT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE details_commande ADD CONSTRAINT FK_4BCD5F682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE details_commande_menu ADD CONSTRAINT FK_5EF664AEE99004AB FOREIGN KEY (details_commande_id) REFERENCES details_commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE details_commande_menu ADD CONSTRAINT FK_5EF664AECCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE details_commande DROP FOREIGN KEY FK_4BCD5F682EA2E54');
        $this->addSql('ALTER TABLE details_commande_menu DROP FOREIGN KEY FK_5EF664AEE99004AB');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6A99F74A');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F6A99F74A');
        $this->addSql('ALTER TABLE details_commande_menu DROP FOREIGN KEY FK_5EF664AECCD7E912');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93B1E7706E');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE details_commande');
        $this->addSql('DROP TABLE details_commande_menu');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE restaurant');
    }
}
