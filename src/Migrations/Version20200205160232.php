<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205160232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tataragne_automated_association_type_rule (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, configuration LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', side VARCHAR(255) DEFAULT NULL, associationType_id INT DEFAULT NULL, INDEX IDX_1EE7A6DEC0B667FB (associationType_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tataragne_automated_association_type_rule ADD CONSTRAINT FK_1EE7A6DEC0B667FB FOREIGN KEY (associationType_id) REFERENCES sylius_product_association_type (id)');
        $this->addSql('ALTER TABLE sylius_product_association_type ADD type VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tataragne_automated_association_type_rule');
        $this->addSql('ALTER TABLE sylius_product_association_type DROP type');
    }
}
