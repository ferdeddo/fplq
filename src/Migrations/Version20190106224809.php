<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190106224809 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE details_commande_menu (details_commande_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_5EF664AEE99004AB (details_commande_id), INDEX IDX_5EF664AECCD7E912 (menu_id), PRIMARY KEY(details_commande_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE details_commande_menu ADD CONSTRAINT FK_5EF664AEE99004AB FOREIGN KEY (details_commande_id) REFERENCES details_commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE details_commande_menu ADD CONSTRAINT FK_5EF664AECCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE details_commande ADD commande_id INT NOT NULL, DROP id_commande, DROP id_menu');
        $this->addSql('ALTER TABLE details_commande ADD CONSTRAINT FK_4BCD5F682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4BCD5F682EA2E54 ON details_commande (commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE details_commande_menu');
        $this->addSql('ALTER TABLE details_commande DROP FOREIGN KEY FK_4BCD5F682EA2E54');
        $this->addSql('DROP INDEX UNIQ_4BCD5F682EA2E54 ON details_commande');
        $this->addSql('ALTER TABLE details_commande ADD id_menu INT NOT NULL, CHANGE commande_id id_commande INT NOT NULL');
    }
}
