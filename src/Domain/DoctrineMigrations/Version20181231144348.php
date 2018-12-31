<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181231144348 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amo_product ADD type_quantity_id INT DEFAULT NULL, CHANGE type_product_id type_product_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_product ADD CONSTRAINT FK_9F3E031835929D6D FOREIGN KEY (type_quantity_id) REFERENCES amo_type_quantity (id)');
        $this->addSql('CREATE INDEX IDX_9F3E031835929D6D ON amo_product (type_quantity_id)');
        $this->addSql('ALTER TABLE amo_recipe CHANGE type_recipe_id type_recipe_id INT DEFAULT NULL, CHANGE preparation_time preparation_time INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_step_recipe CHANGE recipe_id recipe_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_stock_product DROP FOREIGN KEY FK_AF1609B735929D6D');
        $this->addSql('DROP INDEX IDX_AF1609B735929D6D ON amo_stock_product');
        $this->addSql('ALTER TABLE amo_stock_product DROP type_quantity_id, CHANGE product_id product_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_type_product CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_type_quantity CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_type_recipe CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amo_product DROP FOREIGN KEY FK_9F3E031835929D6D');
        $this->addSql('DROP INDEX IDX_9F3E031835929D6D ON amo_product');
        $this->addSql('ALTER TABLE amo_product DROP type_quantity_id, CHANGE type_product_id type_product_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_recipe CHANGE type_recipe_id type_recipe_id INT DEFAULT NULL, CHANGE preparation_time preparation_time INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_step_recipe CHANGE recipe_id recipe_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_stock_product ADD type_quantity_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_stock_product ADD CONSTRAINT FK_AF1609B735929D6D FOREIGN KEY (type_quantity_id) REFERENCES amo_type_quantity (id)');
        $this->addSql('CREATE INDEX IDX_AF1609B735929D6D ON amo_stock_product (type_quantity_id)');
        $this->addSql('ALTER TABLE amo_type_product CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_type_quantity CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE amo_type_recipe CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}
