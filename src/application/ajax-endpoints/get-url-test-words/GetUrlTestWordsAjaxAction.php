<?php

/**
 * Get URL Test Words ajax action
 * ------------------------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Property names with underscores are ok.
 * @noinspection PhpMissingParentCallCommonInspection  - Action parent methods exist as fallback.
 * @noinspection PhpVariableNamingConventionInspection - Short variable names are ok.
 * @noinspection PhpClassNamingConventionInspection    - Long class name is ok.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityApplication;

use Exception;
use Pith\Framework\PithAction;

/**
 * Class GetUrlTestWordsAjaxAction
 * @package WordDensityDemo\WordDensityApplication
 */
class GetUrlTestWordsAjaxAction extends PithAction
{
    private DensityTestService $density_test_service;
    private UrlService $url_service;

    public function __construct(DensityTestService $density_test_service, UrlService $url_service){
        // Set object dependencies
        $this->density_test_service = $density_test_service;
        $this->url_service = $url_service;
    }

    public function runAction()
    {
        // Get user-supplied content from the request fields
        $test_id_unsafe = $_REQUEST['test_id'] ?? 0;

        // Set vars
        $is_successful = false;
        $problem       = '';
        $test_words    = [];

        // Get URLs
        try {
            $test_words    = $this->density_test_service->getTestWordsForTest((int) $test_id_unsafe);
            $is_successful = is_array($test_words);
        } catch (Exception $exception) {
            $problem = $exception->getMessage();
        }

        // Build the response
        $response = [
            'message_status' => 'success',
            'action_status'  => $is_successful ? 'success' : 'failure',
            'data'           => [
                'test_words'   => $test_words,
                'problem'      => $problem,
            ],
        ];

        // Push to Preparer
        $this->prepare->response = $response;
    }
}