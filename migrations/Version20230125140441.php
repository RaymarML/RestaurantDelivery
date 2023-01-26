<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125140441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE customer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE menu_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE menu_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE offer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE offer_menu_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_menu_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE placed_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE restaurant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE status_catalog_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE city (id INT NOT NULL, name VARCHAR(255) NOT NULL, zip_code VARCHAR(16) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, customer_id INT NOT NULL, placed_order_id INT NOT NULL, comment TEXT NOT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_complain BOOLEAN NOT NULL, is_praise BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C9395C3F3 ON comment (customer_id)');
        $this->addSql('CREATE INDEX IDX_9474526C47D7D8EA ON comment (placed_order_id)');
        $this->addSql('CREATE TABLE customer (id INT NOT NULL, city_id INT DEFAULT NULL, customer_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, confirmation_code VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, registration_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_81398E098BAC62AF ON customer (city_id)');
        $this->addSql('CREATE TABLE menu_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE menu_item (id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, ingredients TEXT NOT NULL, recipe TEXT NOT NULL, price DOUBLE PRECISION NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D754D55012469DE2 ON menu_item (category_id)');
        $this->addSql('CREATE TABLE offer (id INT NOT NULL, date_active_from DATE NOT NULL, date_active_to DATE NOT NULL, time_active_from TIME(0) WITHOUT TIME ZONE NOT NULL, time_active_to TIME(0) WITHOUT TIME ZONE NOT NULL, offer_discount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE offer_menu_item (id INT NOT NULL, menu_item_id INT NOT NULL, offer_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7491A8949AB44FE0 ON offer_menu_item (menu_item_id)');
        $this->addSql('CREATE INDEX IDX_7491A89453C674EE ON offer_menu_item (offer_id)');
        $this->addSql('CREATE TABLE order_menu_item (id INT NOT NULL, offer_menu_item_id INT DEFAULT NULL, menu_item_id INT DEFAULT NULL, placed_order_id INT NOT NULL, quatity INT NOT NULL, item_price DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, comment TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6BD3AEA87D8D405B ON order_menu_item (offer_menu_item_id)');
        $this->addSql('CREATE INDEX IDX_6BD3AEA89AB44FE0 ON order_menu_item (menu_item_id)');
        $this->addSql('CREATE INDEX IDX_6BD3AEA847D7D8EA ON order_menu_item (placed_order_id)');
        $this->addSql('CREATE TABLE order_status (id INT NOT NULL, status_catalog_id INT NOT NULL, placed_order_id INT NOT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B88F75C9CD6F827A ON order_status (status_catalog_id)');
        $this->addSql('CREATE INDEX IDX_B88F75C947D7D8EA ON order_status (placed_order_id)');
        $this->addSql('CREATE TABLE placed_order (id INT NOT NULL, restaurant_id INT NOT NULL, customer_id INT NOT NULL, order_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, estimated_delivery TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, food_ready TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, actual_delivery TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, address_delivery VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, discount DOUBLE PRECISION NOT NULL, final_price DOUBLE PRECISION NOT NULL, comment TEXT DEFAULT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_77BB89C5B1E7706E ON placed_order (restaurant_id)');
        $this->addSql('CREATE INDEX IDX_77BB89C59395C3F3 ON placed_order (customer_id)');
        $this->addSql('CREATE TABLE restaurant (id INT NOT NULL, city_id INT NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EB95123F8BAC62AF ON restaurant (city_id)');
        $this->addSql('CREATE TABLE status_catalog (id INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C47D7D8EA FOREIGN KEY (placed_order_id) REFERENCES placed_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_item ADD CONSTRAINT FK_D754D55012469DE2 FOREIGN KEY (category_id) REFERENCES menu_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer_menu_item ADD CONSTRAINT FK_7491A8949AB44FE0 FOREIGN KEY (menu_item_id) REFERENCES menu_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer_menu_item ADD CONSTRAINT FK_7491A89453C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_menu_item ADD CONSTRAINT FK_6BD3AEA87D8D405B FOREIGN KEY (offer_menu_item_id) REFERENCES offer_menu_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_menu_item ADD CONSTRAINT FK_6BD3AEA89AB44FE0 FOREIGN KEY (menu_item_id) REFERENCES menu_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_menu_item ADD CONSTRAINT FK_6BD3AEA847D7D8EA FOREIGN KEY (placed_order_id) REFERENCES placed_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_status ADD CONSTRAINT FK_B88F75C9CD6F827A FOREIGN KEY (status_catalog_id) REFERENCES status_catalog (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_status ADD CONSTRAINT FK_B88F75C947D7D8EA FOREIGN KEY (placed_order_id) REFERENCES placed_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE placed_order ADD CONSTRAINT FK_77BB89C5B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE placed_order ADD CONSTRAINT FK_77BB89C59395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE customer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE menu_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE menu_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE offer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE offer_menu_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE order_menu_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE order_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE placed_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE restaurant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE status_catalog_id_seq CASCADE');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C9395C3F3');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C47D7D8EA');
        $this->addSql('ALTER TABLE customer DROP CONSTRAINT FK_81398E098BAC62AF');
        $this->addSql('ALTER TABLE menu_item DROP CONSTRAINT FK_D754D55012469DE2');
        $this->addSql('ALTER TABLE offer_menu_item DROP CONSTRAINT FK_7491A8949AB44FE0');
        $this->addSql('ALTER TABLE offer_menu_item DROP CONSTRAINT FK_7491A89453C674EE');
        $this->addSql('ALTER TABLE order_menu_item DROP CONSTRAINT FK_6BD3AEA87D8D405B');
        $this->addSql('ALTER TABLE order_menu_item DROP CONSTRAINT FK_6BD3AEA89AB44FE0');
        $this->addSql('ALTER TABLE order_menu_item DROP CONSTRAINT FK_6BD3AEA847D7D8EA');
        $this->addSql('ALTER TABLE order_status DROP CONSTRAINT FK_B88F75C9CD6F827A');
        $this->addSql('ALTER TABLE order_status DROP CONSTRAINT FK_B88F75C947D7D8EA');
        $this->addSql('ALTER TABLE placed_order DROP CONSTRAINT FK_77BB89C5B1E7706E');
        $this->addSql('ALTER TABLE placed_order DROP CONSTRAINT FK_77BB89C59395C3F3');
        $this->addSql('ALTER TABLE restaurant DROP CONSTRAINT FK_EB95123F8BAC62AF');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE menu_category');
        $this->addSql('DROP TABLE menu_item');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_menu_item');
        $this->addSql('DROP TABLE order_menu_item');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('DROP TABLE placed_order');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE status_catalog');
    }
}
