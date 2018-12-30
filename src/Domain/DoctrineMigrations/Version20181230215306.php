<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181230215306 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_product (id INT AUTO_INCREMENT NOT NULL, type_product_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9F3E03185887B07F (type_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_stock_product (id INT AUTO_INCREMENT NOT NULL, type_quantity_id INT DEFAULT NULL, product_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_AF1609B735929D6D (type_quantity_id), INDEX IDX_AF1609B74584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_type_product (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_type_quantity (id INT AUTO_INCREMENT NOT NULL, short_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amo_product ADD CONSTRAINT FK_9F3E03185887B07F FOREIGN KEY (type_product_id) REFERENCES amo_type_product (id)');
        $this->addSql('ALTER TABLE amo_stock_product ADD CONSTRAINT FK_AF1609B735929D6D FOREIGN KEY (type_quantity_id) REFERENCES amo_type_quantity (id)');
        $this->addSql('ALTER TABLE amo_stock_product ADD CONSTRAINT FK_AF1609B74584665A FOREIGN KEY (product_id) REFERENCES amo_product (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amo_stock_product DROP FOREIGN KEY FK_AF1609B74584665A');
        $this->addSql('ALTER TABLE amo_product DROP FOREIGN KEY FK_9F3E03185887B07F');
        $this->addSql('ALTER TABLE amo_stock_product DROP FOREIGN KEY FK_AF1609B735929D6D');
        $this->addSql('DROP TABLE amo_product');
        $this->addSql('DROP TABLE amo_stock_product');
        $this->addSql('DROP TABLE amo_type_product');
        $this->addSql('DROP TABLE amo_type_quantity');
    }
}
