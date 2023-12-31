<?php

/**
 * Run Word Density Test ajax action
 * ---------------------------------
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
 * Class RunWordDensityTestAjaxAction
 * @package WordDensityDemo\WordDensityApplication
 */
class RunWordDensityTestAjaxAction extends PithAction
{
    private DensityTestService $density_test_service;
    private UrlService $url_service;

    public function __construct(DensityTestService $density_test_service, UrlService $url_service){
        // Set object dependencies
        $this->density_test_service = $density_test_service;
        $this->url_service          = $url_service;
    }

    public function runAction()
    {
        // Get user-supplied content from the request fields
        $url_id_unsafe = $_REQUEST['url_id'] ?? '';
        $url_unsafe    = $_REQUEST['url'] ?? '';

        // Set vars
        $is_successful   = false;
        $problem         = '';

        // Add URL
        try {
            $is_url_valid    = $this->url_service->isUrlValid($url_unsafe);
            if($is_url_valid){
                $density_test_info    = $this->density_test_service->runWordDensityTest((int) $url_id_unsafe, $url_unsafe);
                $test_id              = $density_test_info['density_test_id'];
                $url_content_html     = $density_test_info['url_content_html'];
                $url_content_text     = $density_test_info['url_content_text'];
                $url_words            = $density_test_info['url_words'];
                $url_word_occurrences = $density_test_info['url_word_occurrences'];
                $is_successful        = $test_id > 0;
            }
            else{
                $problem = 'Url must be a valid url';
            }
        } catch (Exception $exception) {
            $problem = $exception->getMessage();
        }

        // Build the response
        $response = [
            'message_status' => 'success',
            'action_status'  => $is_successful ? 'success' : 'failure',
            'data'           => [
                'problem'              => $problem,
                'test_id'              => $test_id ?? 0,
             // 'url_content_html'     => $url_content_html ?? '',
             // 'url_content_text'     => $url_content_text ?? '',
             // 'url_words'            => $url_words ?? [],
                'url_word_occurrences' => $url_word_occurrences ?? [],
            ],
        ];

        // Push to Preparer
        $this->prepare->response = $response;
    }
}