<?php

/**
 * Density Test Gateway
 * --------------------
 *
 * @noinspection PhpPropertyNamingConventionInspection      - Long property names are ok.
 * @noinspection PhpMethodNamingConventionInspection        - Long method names are ok.
 * @noinspection PhpVariableNamingConventionInspection      - Short variable names are ok.
 * @noinspection PhpUnnecessaryLocalVariableInspection      - Ignore for readability.
 * @noinspection PhpArrayShapeAttributeCanBeAddedInspection - Ignore shape for now, add later.
 * @noinspection PhpIllegalPsrClassPathInspection           - Ignore, using PSR 4 not 0.
 * @noinspection PhpUnusedLocalVariableInspection           - Readability.
 */


declare(strict_types=1);


namespace WordDensityDemo\WordDensityApplication;


use Exception;
use PDO;
use Pith\Framework\PithDatabaseWrapper;
use Pith\Framework\PithException;

/**
 * Class DensityTestGateway
 * @package WordDensityDemo\WordDensityApplication
 */
class DensityTestGateway
{
    private PithDatabaseWrapper $database;

    public function __construct(PithDatabaseWrapper $database)
    {
        // Set object dependencies:
        $this->database = $database;
    }

    /**
     * @param  int $url_id
     * @return int
     * @throws PithException
     * @throws Exception
     */
    public function insertNewDensityTest(int $url_id): int
    {
        // Connect if not connected
        $this->database->connectOnce();

        // Query
        $sql = '
            INSERT INTO `density_tests` 
                (url_id) 
            VALUES 
                (:url_id) 
            ';

        // Prepare
        $statement = $this->database->pdo->prepare($sql);

        // Execute
        $statement->execute(
            [
                ':url_id' => $url_id,
            ]
        );

        // Get inserted id
        $inserted_id = $this->database->pdo->lastInsertId() ?: 0;
        if($inserted_id === 0){
            throw new Exception('Failed to insert to the URL table.');
        }

        // Return the inserted id
        return (int) $inserted_id;
    }


    /**
     * @param int $url_id
     * @return array
     * @throws PithException
     */
    public function getTestsForUrl(int $url_id): array
    {
        // Connect if not connected
        $this->database->connectOnce();

        // Query
        $sql = '
            SELECT
                *
            FROM 
                density_tests AS t
            WHERE
                t.url_id = :url_id
            ';

        // Prepare
        $statement = $this->database->pdo->prepare($sql);

        // Execute
        $statement->execute(
            [
                ':url_id' => $url_id,
            ]
        );

        // Get results
        $rows          = $statement->fetchAll(PDO::FETCH_ASSOC);
        $did_find_rows = $rows && count($rows);
        $results       = $did_find_rows ? $rows : [];

        // Return results
        return $results;
    }

    /**
     * @param int $test_id
     * @return array
     * @throws PithException
     */
    public function getTestWordsForTest(int $test_id): array
    {
        // Default to an empty array
        $results = [];

        // Connect if not connected
        $this->database->connectOnce();

        // Query
        $sql = '
            SELECT
                tw.density_test_word_id,
                tw.density_test_id,
                tw.word_id,
                w.word,
                tw.word_count,
                tw.word_density,
                w.is_common_syntax_word
            FROM 
                density_test_words AS tw
            LEFT JOIN
                words AS w 
                ON tw.word_id = w.word_id
            WHERE
                tw.density_test_id = :density_test_id
            ORDER BY
                w.is_common_syntax_word ASC,
                tw.word_density DESC 
            ';

        // Prepare
        $statement = $this->database->pdo->prepare($sql);

        // Execute
        $statement->execute(
            [
                ':density_test_id' => $test_id,
            ]
        );

        // Get results
        $rows          = $statement->fetchAll(PDO::FETCH_ASSOC);
        $did_find_rows = $rows && count($rows);
        $results       = $did_find_rows ? $rows : [];

        // Return results
        return $results;
    }


}