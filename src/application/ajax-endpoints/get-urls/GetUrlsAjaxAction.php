<?php

/**
 * Get URLs ajax action
 * --------------------
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
 * Class GetUrlsAjaxAction
 * @package WordDensityDemo\WordDensityApplication
 */
class GetUrlsAjaxAction extends PithAction
{
    private UrlService $url_service;

    public function __construct(UrlService $url_service){
        // Set object dependencies
        $this->url_service = $url_service;
    }

    public function runAction()
    {
        // Set vars
        $is_successful = false;
        $problem       = '';
        $urls          = [];

        // Get URLs
        try {
            //$urls = $this->url_service->getUrls();
        } catch (Exception $exception) {
            $problem = $exception->getMessage();
        }

        // Build the response
        $response = [
            'message_status' => 'success',
            'action_status'  => $is_successful ? 'success' : 'failure',
            'data'           => [
                'urls'    => $urls,
                'problem' => $problem,
            ],
        ];

        // Push to Preparer
        $this->prepare->response = $response;
    }
}