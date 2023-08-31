<?php

/**
 * Word Gateway
 * ------------
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
 * Class WordGateway
 * @package WordDensityDemo\WordDensityApplication
 */
class WordGateway
{
    private PithDatabaseWrapper $database;

    public function __construct(PithDatabaseWrapper $database)
    {
        // Set object dependencies:
        $this->database = $database;
    }

    /**
     * @param string $word
     * @return int
     * @throws PithException
     * @throws Exception
     */
    public function obtainIdForWord(string $word): int
    {
        // Default to zero
        $word_id = 0;

        // Connect if not connected
        $this->database->connectOnce();

        // Query
        $sql = '
            SELECT
                *
            FROM 
                `words` AS w
            WHERE
                w.word = :word
            ';

        // Prepare
        $statement = $this->database->pdo->prepare($sql);

        // Execute
        $statement->execute(
            [
                ':word' => $word,
            ]
        );

        // Get results
        $rows          = $statement->fetchAll(PDO::FETCH_ASSOC);
        $did_find_rows = $rows && count($rows);

        if($did_find_rows){
            $row = $rows[0];
            $word_id = $row['word_id'];
        }
        else{
            // Query
            $sql = '
            INSERT INTO `words`
                (`word`) 
            VALUES 
                (:word) 
            ';

            // Prepare
            $statement = $this->database->pdo->prepare($sql);

            // Execute
            $statement->execute(
                [
                    ':word' => $word,
                ]
            );

            // Get inserted id
            $word_id = $this->database->pdo->lastInsertId() ?: 0;
            if($word_id === 0){
                throw new Exception('Failed to insert to the words table.');
            }
        }

        return (int) $word_id;
    }

}