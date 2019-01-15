<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190115155916 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE boisson CHANGE description description LONGTEXT DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE dessert CHANGE description description LONGTEXT DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE entree CHANGE description description LONGTEXT DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL, CHANGE photo photo VARCHAR(180) DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE description description LONGTEXT DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE restaurant CHANGE commande_min commande_min DOUBLE PRECISION NOT NULL, CHANGE prix_livraison prix_livraison DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE boisson CHANGE description description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE prix prix INT NOT NULL');
        $this->addSql('ALTER TABLE dessert CHANGE description description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE prix prix INT NOT NULL');
        $this->addSql('ALTER TABLE entree CHANGE description description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE prix prix INT NOT NULL, CHANGE photo photo VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE menu CHANGE description description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE prix prix INT NOT NULL');
        $this->addSql('ALTER TABLE restaurant CHANGE commande_min commande_min INT NOT NULL, CHANGE prix_livraison prix_livraison INT NOT NULL');
    }
}
