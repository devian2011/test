<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621004502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE countries (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE coupons (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, seller_id INTEGER DEFAULT NULL, code VARCHAR(255) NOT NULL, value DOUBLE PRECISION NOT NULL, type INTEGER NOT NULL, CONSTRAINT FK_F56411188DE820D9 FOREIGN KEY (seller_id) REFERENCES sellers (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F564111877153098 ON coupons (code)');
        $this->addSql('CREATE INDEX IDX_F56411188DE820D9 ON coupons (seller_id)');
        $this->addSql('CREATE TABLE goods (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE purchases (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tax_number VARCHAR(255) NOT NULL, coupon VARCHAR(255) DEFAULT NULL, payment_processor VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, good_id INTEGER NOT NULL, payed BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE sellers (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE taxes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER DEFAULT NULL, pattern VARCHAR(255) NOT NULL, tax_percent DOUBLE PRECISION NOT NULL, CONSTRAINT FK_C28EA7F8F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C28EA7F8F92F3E70 ON taxes (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE coupons');
        $this->addSql('DROP TABLE goods');
        $this->addSql('DROP TABLE purchases');
        $this->addSql('DROP TABLE sellers');
        $this->addSql('DROP TABLE taxes');
    }
}
