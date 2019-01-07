<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190106210553 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livraison ADD membre_id INT NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F6A99F74A ON livraison (membre_id)');
        $this->addSql('ALTER TABLE commande ADD id_membre_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DEAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DEAAC4B6D ON commande (id_membre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEAAC4B6D');
        $this->addSql('DROP INDEX IDX_6EEAA67DEAAC4B6D ON commande');
        $this->addSql('ALTER TABLE commande DROP id_membre_id');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F6A99F74A');
        $this->addSql('DROP INDEX IDX_A60C9F1F6A99F74A ON livraison');
        $this->addSql('ALTER TABLE livraison DROP membre_id');
    }
}
