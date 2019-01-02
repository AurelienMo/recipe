<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190102231153 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_group_user (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7F75926C7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_user (id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_7C34BEA9FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amo_group_user ADD CONSTRAINT FK_7F75926C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES amo_user (id)');
        $this->addSql('ALTER TABLE amo_user ADD CONSTRAINT FK_7C34BEA9FE54D947 FOREIGN KEY (group_id) REFERENCES amo_group_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE amo_product CHANGE type_product_id type_product_id INT NOT NULL, CHANGE type_quantity_id type_quantity_id INT NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_product_recipe CHANGE type_quantity_id type_quantity_id INT NOT NULL, CHANGE product_id product_id INT NOT NULL, CHANGE recipe_id recipe_id INT NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_recipe CHANGE type_recipe_id type_recipe_id INT NOT NULL, CHANGE preparation_time preparation_time INT NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_step_recipe CHANGE recipe_id recipe_id INT NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_stock_product ADD group_id INT NOT NULL, CHANGE product_id product_id INT NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_stock_product ADD CONSTRAINT FK_AF1609B7FE54D947 FOREIGN KEY (group_id) REFERENCES amo_group_user (id)');
        $this->addSql('CREATE INDEX IDX_AF1609B7FE54D947 ON amo_stock_product (group_id)');
        $this->addSql('ALTER TABLE amo_type_product CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_type_quantity CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_type_recipe CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amo_stock_product DROP FOREIGN KEY FK_AF1609B7FE54D947');
        $this->addSql('ALTER TABLE amo_user DROP FOREIGN KEY FK_7C34BEA9FE54D947');
        $this->addSql('ALTER TABLE amo_group_user DROP FOREIGN KEY FK_7F75926C7E3C61F9');
        $this->addSql('DROP TABLE amo_group_user');
        $this->addSql('DROP TABLE amo_user');
        $this->addSql('ALTER TABLE amo_product CHANGE type_product_id type_product_id INT DEFAULT NULL, CHANGE type_quantity_id type_quantity_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_product_recipe CHANGE type_quantity_id type_quantity_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL, CHANGE recipe_id recipe_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_recipe CHANGE type_recipe_id type_recipe_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\', CHANGE preparation_time preparation_time INT DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_step_recipe CHANGE recipe_id recipe_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('DROP INDEX IDX_AF1609B7FE54D947 ON amo_stock_product');
        $this->addSql('ALTER TABLE amo_stock_product DROP group_id, CHANGE product_id product_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_type_product CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_type_quantity CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_type_recipe CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}
