<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621004503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $sql = file_get_contents(__DIR__ . '/sql/Version20240621004503.sql');
        $this->connection->getNativeConnection()->exec($sql);
    }

    public function down(Schema $schema): void
    {
        throw new \RuntimeException("cannot revert ". __CLASS__." migration");
    }
}
