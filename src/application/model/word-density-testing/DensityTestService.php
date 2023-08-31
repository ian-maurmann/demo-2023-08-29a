<?php

/**
 * Density Test Service
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
use Pith\Framework\PithException;

/**
 * Class DensityTestService
 * @package WordDensityDemo\WordDensityApplication
 */
class DensityTestService
{
    private DensityTestGateway $density_test_gateway;
    private UrlGateway $url_gateway;

    public function __construct(DensityTestGateway $density_test_gateway, UrlGateway $url_gateway)
    {
        // Set object dependencies:
        $this->density_test_gateway = $density_test_gateway;
        $this->url_gateway          = $url_gateway;
    }

    /**
     * @throws PithException
     */
    public function runWordDensityTest(int $url_id, string $url): array
    {
        $test_id     = $this->density_test_gateway->insertNewDensityTest($url_id);
        $url_content = $this->fetchUrlContent($url);

        $density_test_info = [
            'density_test_id' => $test_id,
            'url_content'     => $url_content,
        ];

        return $density_test_info;
    }

    /**
     * @param string $url
     * @param string $useragent
     * @return bool|string
     */
    public function fetchUrlContent(string $url, string $useragent='cURL'): bool|string
    {
        $curl_handle = curl_init();

        // Set options
        curl_setopt($curl_handle, CURLOPT_URL, $url); // URL
        // curl_setopt($curl_handle, CURLOPT_BINARYTRANSFER, true); // Used to need this
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true); // To get the contents of the URL
        curl_setopt($curl_handle, CURLOPT_FRESH_CONNECT, true); // New session
        curl_setopt($curl_handle, CURLOPT_FAILONERROR, true); // Fail on error
        curl_setopt($curl_handle, CURLOPT_USERAGENT, $useragent); // User Agent String
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false); // Ignore SSL errors

        // Execute
        $response = curl_exec($curl_handle);
        $worked   = curl_errno($curl_handle) === 0;

        // Close
        curl_close($curl_handle);

        return $worked ? $response : false;
    }

}