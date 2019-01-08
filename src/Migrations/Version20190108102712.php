<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108102712 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS=0; ALTER TABLE restaurant DROP type, CHANGE typer_id type_id INT NOT NULL');
        $this->addSql('SET FOREIGN_KEY_CHECKS=0; ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('SET FOREIGN_KEY_CHECKS=0; CREATE INDEX IDX_EB95123FC54C8C93 ON restaurant (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FC54C8C93');
        $this->addSql('DROP INDEX IDX_EB95123FC54C8C93 ON restaurant');
        $this->addSql('ALTER TABLE restaurant ADD type VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE type_id typer_id INT NOT NULL');
    }
}
