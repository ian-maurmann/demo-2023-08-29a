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
use Html2Text\Html2Text;
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
        // Create new text
        $test_id = $this->density_test_gateway->insertNewDensityTest($url_id);

        // Get HTML from URL
        $url_content_html = $this->fetchUrlContent($url);

        // Set options for Html2Text
        $options = [
            'do_links' => 'none',
            'width'    => 0,
        ];

        // Use Html2Text to get text
        $html2text = new Html2Text($url_content_html, $options);
        $url_content_text_with_escapes = $html2text->getText();

        // Cleanup text
        $url_content_text = preg_replace("/[^A-Za-z ]/", ' ', $url_content_text_with_escapes);
        $url_content_text_lower_case = mb_strtolower($url_content_text);
        $url_content_text_less_whitespace = trim(preg_replace( '/\s+/', ' ', $url_content_text_lower_case ));

        // Get words
        $url_words = explode(' ', $url_content_text_less_whitespace);

        // Build array of test info
        $density_test_info = [
            'density_test_id'  => $test_id,
            'url_content_html' => $url_content_html,
            'url_content_text' => $url_content_text,
            'url_words'        => $url_words,
        ];

        // Return test info
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