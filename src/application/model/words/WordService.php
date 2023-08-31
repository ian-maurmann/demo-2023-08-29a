<?php

/**
 * Word Service
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
use Pith\Framework\PithException;

/**
 * Class WordService
 * @package WordDensityDemo\WordDensityApplication
 */
class WordService
{
    private WordGateway $word_gateway;

    public function __construct(WordGateway $word_gateway)
    {
        // Set object dependencies:
        $this->word_gateway = $word_gateway;
    }

    /**
     * @throws Exception
     */
    public function saveTopUrlWords(int $url_id, string $url, int $test_id, int $url_word_count, array $url_word_occurrences)
    {
        // Loop through the words
        $word_rank = 0;
        foreach ($url_word_occurrences as $word_as_key => $occurrences){
            $word = (string) $word_as_key; // Quick-fix for numbers sometimes being words

            // Increment the word's place in the ranking, we're starting at the highest, stopping a bit after 20.
            $word_rank++;

            // Once we've hit the low-rank words, stop looping
            if($word_rank > 40){
                break;
            }

            // Add word to the words table if it's not already there, Get the word id
            $word_id = $this->obtainIdForWord($word);
        }
    }

    /**
     * @throws Exception
     */
    public function obtainIdForWord(string $word): int
    {
        // Get word id if exists, else create new word get the new word id
        $word_id = $this->word_gateway->obtainIdForWord($word);

        // Return the new word id as int
        return $word_id;
    }


}