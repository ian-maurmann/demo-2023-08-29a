<?php

/**
 * Migration to add density_tests table
 * ------------------------------------
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
final class Version20230830033622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table `density_tests`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE density_tests (
                `density_test_id` INT AUTO_INCREMENT NOT NULL, 
                `url_id` INT NOT NULL,
                `datetime_ran_test` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(density_test_id),
                CONSTRAINT `density_tests_fk_url_id`
                    FOREIGN KEY (`url_id`) REFERENCES `urls`(`url_id`)
            )
            ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci
            '
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE density_tests');
    }
}
