<?php

/**
 * Migration to add `density_test_words` table
 * ------------------------------
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
final class Version20230830035749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table `density_test_words`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE density_test_words (
                `density_test_word_id` INT AUTO_INCREMENT NOT NULL, 
                `density_test_id` INT NOT NULL,
                `word_id` INT NOT NULL,
                `word_count` INT NOT NULL,
                `word_density` INT NOT NULL,
                PRIMARY KEY(density_test_word_id),
                CONSTRAINT `density_test_words_fk_density_test_id`
                    FOREIGN KEY (`density_test_id`) REFERENCES `density_tests`(`density_test_id`),
                CONSTRAINT `density_test_words_fk_word_id`
                    FOREIGN KEY (`word_id`) REFERENCES `words`(`word_id`)
            )
            ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci
            '
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `density_test_words`');
    }
}
