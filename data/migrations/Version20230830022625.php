<?php

/**
 * Migration to add url_notes table
 * --------------------------------
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
final class Version20230830022625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table `url_notes`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE url_notes (
                `url_note_id` INT AUTO_INCREMENT NOT NULL, 
                `url_id` INT NOT NULL,
                `datetime_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `datetime_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(url_note_id),
                CONSTRAINT `url_notes_fk_url_id` 
                    FOREIGN KEY (`url_id`) REFERENCES `urls`(`url_id`)
            )
            ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci
            '
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE url_notes');
    }
}
