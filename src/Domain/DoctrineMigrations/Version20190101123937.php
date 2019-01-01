<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190101123937 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_product_recipe (id INT AUTO_INCREMENT NOT NULL, type_quantity_id INT DEFAULT NULL, product_id INT DEFAULT NULL, recipe_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_A2C01A635929D6D (type_quantity_id), INDEX IDX_A2C01A64584665A (product_id), INDEX IDX_A2C01A659D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amo_product_recipe ADD CONSTRAINT FK_A2C01A635929D6D FOREIGN KEY (type_quantity_id) REFERENCES amo_type_quantity (id)');
        $this->addSql('ALTER TABLE amo_product_recipe ADD CONSTRAINT FK_A2C01A64584665A FOREIGN KEY (product_id) REFERENCES amo_product (id)');
        $this->addSql('ALTER TABLE amo_product_recipe ADD CONSTRAINT FK_A2C01A659D8A214 FOREIGN KEY (recipe_id) REFERENCES amo_recipe (id)');
        $this->addSql('DROP TABLE amo_recipe_has_product');
        $this->addSql('ALTER TABLE amo_product CHANGE type_product_id type_product_id INT DEFAULT NULL, CHANGE type_quantity_id type_quantity_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_recipe CHANGE type_recipe_id type_recipe_id INT DEFAULT NULL, CHANGE preparation_time preparation_time INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_step_recipe CHANGE recipe_id recipe_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_stock_product CHANGE product_id product_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_type_product CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_type_quantity CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_type_recipe CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_recipe_has_product (recipe_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_7F34AED14584665A (product_id), INDEX IDX_7F34AED159D8A214 (recipe_id), PRIMARY KEY(recipe_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE amo_recipe_has_product ADD CONSTRAINT FK_7F34AED14584665A FOREIGN KEY (product_id) REFERENCES amo_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE amo_recipe_has_product ADD CONSTRAINT FK_7F34AED159D8A214 FOREIGN KEY (recipe_id) REFERENCES amo_recipe (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE amo_product_recipe');
        $this->addSql('ALTER TABLE amo_product CHANGE type_product_id type_product_id INT DEFAULT NULL, CHANGE type_quantity_id type_quantity_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_recipe CHANGE type_recipe_id type_recipe_id INT DEFAULT NULL, CHANGE preparation_time preparation_time INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_step_recipe CHANGE recipe_id recipe_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_stock_product CHANGE product_id product_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_type_product CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_type_quantity CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_type_recipe CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}
