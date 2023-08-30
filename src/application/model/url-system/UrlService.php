<?php

/**
 * URL Service
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

/**
 * Class UrlService
 * @package WordDensityDemo\WordDensityApplication
 */
class UrlService
{
    private UrlGateway $url_gateway;

    public function __construct(UrlGateway $url_gateway)
    {
        // Set object dependencies:
        $this->url_gateway = $url_gateway;
    }

    /**
     * @param string $url
     * @return int
     * @throws Exception
     */
    public function addNewUrl(string $url): int
    {
        // Add new url
        $url_id = $this->url_gateway->addNewUrl($url);

        // Return the new url id
        return $url_id;
    }

    /**
     * @param string $given_url
     * @return bool
     */
    public function isUrlValid(string $given_url): bool
    {
        // Default to false
        $is_url_valid = false;

        // Check if URL is valid
        if (filter_var($given_url, FILTER_VALIDATE_URL) !== false) {
            $is_url_valid = true;
        }

        // Return true if the URL is valid, else return false
        return $is_url_valid;
    }


}