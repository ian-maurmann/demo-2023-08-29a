<?php

/**
 * Migration to add urls table
 * ---------------------------
 *
 * @noinspection PhpClassNamingConventionInspection   - Long class name is ok.
 * @noinspection PhpMissingParentCallCommonInspection - Parent method calls are not needed.
 * @noinspection PhpMethodNamingConventionInspection  - Short method names are ok.
 * @noinspection PhpUnused                            - Ignore.
 */

declare(strict_types=1);

namespace WordDensityDemo\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration
 */
final class Version20230830014209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table `urls`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE urls (
                `url_id` INT AUTO_INCREMENT NOT NULL, 
                `url` VARCHAR(191) UNIQUE NOT NULL,
                `datetime_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(url_id)
            )
            ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci
            '
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE urls');
    }
}
