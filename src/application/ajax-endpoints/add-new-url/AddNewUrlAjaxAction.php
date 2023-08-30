<?php

/**
 * Add New URL ajax action
 * -----------------------
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
 * Class AddNewUrlAjaxAction
 * @package WordDensityDemo\WordDensityApplication
 */
class AddNewUrlAjaxAction extends PithAction
{
    private UrlService $url_service;

    public function __construct(UrlService $url_service){
        // Set object dependencies
        $this->url_service = $url_service;
    }

    public function runAction()
    {
        // Get user-supplied content from the request fields
        $new_url_unsafe = $_REQUEST['new_url'] ?? '';

        // Set vars
        $did_add_new_url = false;
        $is_successful   = false;
        $problem         = '';
        $is_url_valid    = $this->url_service->isUrlValid($new_url_unsafe);

        // Add URL
        try {
            if($is_url_valid){
                $did_add_new_url = $this->url_service->addNewUrl($new_url_unsafe);
                $is_successful   = $did_add_new_url;
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
                'did_add_new_url' => $did_add_new_url ? 'yes' : 'no',
                'problem'         => $problem,
            ],
        ];

        // Push to Preparer
        $this->prepare->response = $response;
    }
}