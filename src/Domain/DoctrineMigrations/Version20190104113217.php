<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190104113217 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_group_user (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7F75926C7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_product (id INT AUTO_INCREMENT NOT NULL, type_product_id INT NOT NULL, type_quantity_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_9F3E03185887B07F (type_product_id), INDEX IDX_9F3E031835929D6D (type_quantity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_product_recipe (id INT AUTO_INCREMENT NOT NULL, type_quantity_id INT NOT NULL, product_id INT NOT NULL, recipe_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_A2C01A635929D6D (type_quantity_id), INDEX IDX_A2C01A64584665A (product_id), INDEX IDX_A2C01A659D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_recipe (id INT AUTO_INCREMENT NOT NULL, type_recipe_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, preparation_time INT NOT NULL, INDEX IDX_C79F5A16ED1EE304 (type_recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_step_recipe (id INT AUTO_INCREMENT NOT NULL, recipe_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, description LONGTEXT NOT NULL, number INT NOT NULL, INDEX IDX_EC4C652959D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_stock_product (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, group_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_AF1609B74584665A (product_id), INDEX IDX_AF1609B7FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_type_product (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_type_quantity (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_type_recipe (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_user (id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_7C34BEA9FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amo_group_user ADD CONSTRAINT FK_7F75926C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES amo_user (id)');
        $this->addSql('ALTER TABLE amo_product ADD CONSTRAINT FK_9F3E03185887B07F FOREIGN KEY (type_product_id) REFERENCES amo_type_product (id)');
        $this->addSql('ALTER TABLE amo_product ADD CONSTRAINT FK_9F3E031835929D6D FOREIGN KEY (type_quantity_id) REFERENCES amo_type_quantity (id)');
        $this->addSql('ALTER TABLE amo_product_recipe ADD CONSTRAINT FK_A2C01A635929D6D FOREIGN KEY (type_quantity_id) REFERENCES amo_type_quantity (id)');
        $this->addSql('ALTER TABLE amo_product_recipe ADD CONSTRAINT FK_A2C01A64584665A FOREIGN KEY (product_id) REFERENCES amo_product (id)');
        $this->addSql('ALTER TABLE amo_product_recipe ADD CONSTRAINT FK_A2C01A659D8A214 FOREIGN KEY (recipe_id) REFERENCES amo_recipe (id)');
        $this->addSql('ALTER TABLE amo_recipe ADD CONSTRAINT FK_C79F5A16ED1EE304 FOREIGN KEY (type_recipe_id) REFERENCES amo_type_recipe (id)');
        $this->addSql('ALTER TABLE amo_step_recipe ADD CONSTRAINT FK_EC4C652959D8A214 FOREIGN KEY (recipe_id) REFERENCES amo_recipe (id)');
        $this->addSql('ALTER TABLE amo_stock_product ADD CONSTRAINT FK_AF1609B74584665A FOREIGN KEY (product_id) REFERENCES amo_product (id)');
        $this->addSql('ALTER TABLE amo_stock_product ADD CONSTRAINT FK_AF1609B7FE54D947 FOREIGN KEY (group_id) REFERENCES amo_group_user (id)');
        $this->addSql('ALTER TABLE amo_user ADD CONSTRAINT FK_7C34BEA9FE54D947 FOREIGN KEY (group_id) REFERENCES amo_group_user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amo_stock_product DROP FOREIGN KEY FK_AF1609B7FE54D947');
        $this->addSql('ALTER TABLE amo_user DROP FOREIGN KEY FK_7C34BEA9FE54D947');
        $this->addSql('ALTER TABLE amo_product_recipe DROP FOREIGN KEY FK_A2C01A64584665A');
        $this->addSql('ALTER TABLE amo_stock_product DROP FOREIGN KEY FK_AF1609B74584665A');
        $this->addSql('ALTER TABLE amo_product_recipe DROP FOREIGN KEY FK_A2C01A659D8A214');
        $this->addSql('ALTER TABLE amo_step_recipe DROP FOREIGN KEY FK_EC4C652959D8A214');
        $this->addSql('ALTER TABLE amo_product DROP FOREIGN KEY FK_9F3E03185887B07F');
        $this->addSql('ALTER TABLE amo_product DROP FOREIGN KEY FK_9F3E031835929D6D');
        $this->addSql('ALTER TABLE amo_product_recipe DROP FOREIGN KEY FK_A2C01A635929D6D');
        $this->addSql('ALTER TABLE amo_recipe DROP FOREIGN KEY FK_C79F5A16ED1EE304');
        $this->addSql('ALTER TABLE amo_group_user DROP FOREIGN KEY FK_7F75926C7E3C61F9');
        $this->addSql('DROP TABLE amo_group_user');
        $this->addSql('DROP TABLE amo_product');
        $this->addSql('DROP TABLE amo_product_recipe');
        $this->addSql('DROP TABLE amo_recipe');
        $this->addSql('DROP TABLE amo_step_recipe');
        $this->addSql('DROP TABLE amo_stock_product');
        $this->addSql('DROP TABLE amo_type_product');
        $this->addSql('DROP TABLE amo_type_quantity');
        $this->addSql('DROP TABLE amo_type_recipe');
        $this->addSql('DROP TABLE amo_user');
    }
}
