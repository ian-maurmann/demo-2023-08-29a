<?php

/**
 * Density Test Word Gateway
 * -------------------------
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
 * Class DensityTestWordGateway
 * @package WordDensityDemo\WordDensityApplication
 */
class DensityTestWordGateway
{
    private PithDatabaseWrapper $database;

    public function __construct(PithDatabaseWrapper $database)
    {
        // Set object dependencies:
        $this->database = $database;
    }

    /**
     * @param int $test_id
     * @param int $word_id
     * @param int $occurrences
     * @param int $word_density_per_10k_as_int
     * @return int
     * @throws Exception|PithException
     */
    public function addTestWord(int $test_id, int $word_id, int $occurrences, int $word_density_per_10k_as_int): int
    {
        // Default to zero
        $inserted_id = 0;

        // Connect if not connected
        $this->database->connectOnce();

        // Query
        $sql = '
            INSERT INTO `density_test_words`
                (density_test_id, word_id, word_count, word_density) 
            VALUES 
                (:density_test_id, :word_id, :word_count, :word_density) 
            ';

        // Prepare
        $statement = $this->database->pdo->prepare($sql);

        // Execute
        $statement->execute(
            [
                ':density_test_id' => $test_id,
                ':word_id'         => $word_id,
                ':word_count'      => $occurrences,
                ':word_density'    => $word_density_per_10k_as_int,
            ]
        );

        // Get inserted id
        $inserted_id = $this->database->pdo->lastInsertId() ?: 0;
        if($inserted_id === 0){
            throw new Exception('Failed to insert to the density_test_words table.');
        }

        // Return the inserted id
        return (int) $inserted_id;
    }

}