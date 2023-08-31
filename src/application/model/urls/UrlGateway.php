<?php

/**
 * URL Gateway
 * -----------
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
 * Class UrlGateway
 * @package WordDensityDemo\WordDensityApplication
 */
class UrlGateway
{
    private PithDatabaseWrapper $database;

    public function __construct(PithDatabaseWrapper $database)
    {
        // Set object dependencies:
        $this->database = $database;
    }


    /**
     * @param string $url
     * @return int
     * @throws Exception
     */
    public function addNewUrl(string $url): int
    {
        // Query
        $sql = '
            INSERT INTO `urls` 
                (url) 
            VALUES 
                (:url) 
            ';

        // Connect if not connected
        $this->database->connectOnce();

        // Prepare
        $statement = $this->database->pdo->prepare($sql);

        // Execute
        $statement->execute(
            [
                ':url' => $url,
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
     * @return array
     * @throws PithException
     */
    public function getUrls(): array
    {
        // Connect if not connected
        $this->database->connectOnce();

        // Query
        $sql = '
            SELECT
                *
            FROM 
                urls
            ';

        // Prepare
        $statement = $this->database->pdo->prepare($sql);

        // Execute
        $statement->execute();

        // Get results
        $rows          = $statement->fetchAll(PDO::FETCH_ASSOC);
        $did_find_rows = $rows && count($rows);
        $results       = $did_find_rows ? $rows : [];

        // Return results
        return $results;
    }


}