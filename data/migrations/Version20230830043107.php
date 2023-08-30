<?php

/**
 * Migration to populate `words` table with too-common words
 * ---------------------------------------------------------
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
final class Version20230830043107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate common words to table `words`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (1, 'a', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (2, 'an', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (3, 'and', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (4, 'are', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (5, 'as', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (6, 'at', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (7, 'be', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (8, 'but', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (9, 'for', 1)");

        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (10, 'form', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (11, 'had', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (12, 'has', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (13, 'have', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (14, 'he', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (15, 'her', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (16, 'his', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (17, 'how', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (18, 'in', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (19, 'is', 1)");

        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (20, 'it', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (21, 'my', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (22, 'of', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (23, 'or', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (24, 'our', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (25, 'she', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (26, 'that', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (27, 'the', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (28, 'there', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (29, 'their', 1)");

        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (30, 'this', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (31, 'to', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (32, 'we', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (33, 'who', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (34, 'you', 1)");
        $this->addSql("INSERT INTO `words` (word_id, word, is_common_syntax_word) VALUES (35, 'your', 1)");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM `words` WHERE word_id < 36');
    }
}
