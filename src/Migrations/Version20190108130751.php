<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108130751 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS=0; CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('SET FOREIGN_KEY_CHECKS=0; ALTER TABLE membre ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('SET FOREIGN_KEY_CHECKS=0; ALTER TABLE restaurant ADD type_id INT NOT NULL, ADD telephone INT NOT NULL, DROP type');
        $this->addSql('SET FOREIGN_KEY_CHECKS=0; ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('SET FOREIGN_KEY_CHECKS=0; CREATE INDEX IDX_EB95123FC54C8C93 ON restaurant (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FC54C8C93');
        $this->addSql('DROP TABLE type');
        $this->addSql('ALTER TABLE membre DROP roles');
        $this->addSql('DROP INDEX IDX_EB95123FC54C8C93 ON restaurant');
        $this->addSql('ALTER TABLE restaurant ADD type VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, DROP type_id, DROP telephone');
    }
}
