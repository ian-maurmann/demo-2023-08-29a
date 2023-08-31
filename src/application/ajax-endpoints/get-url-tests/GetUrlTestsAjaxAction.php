<?php

/**
 * Get URL Tests ajax action
 * -------------------------
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
 * Class GetUrlTestsAjaxAction
 * @package WordDensityDemo\WordDensityApplication
 */
class GetUrlTestsAjaxAction extends PithAction
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
        $url_id_unsafe = $_REQUEST['url_id'] ?? '';

        // Set vars
        $is_successful = false;
        $problem       = '';
        $tests         = [];

        // Get URLs
        try {
            $tests         = $this->density_test_service->getTestsForUrl((int) $url_id_unsafe);
            $is_successful = is_array($tests);
        } catch (Exception $exception) {
            $problem = $exception->getMessage();
        }

        // Build the response
        $response = [
            'message_status' => 'success',
            'action_status'  => $is_successful ? 'success' : 'failure',
            'data'           => [
                'tests'   => $tests,
                'problem' => $problem,
            ],
        ];

        // Push to Preparer
        $this->prepare->response = $response;
    }
}