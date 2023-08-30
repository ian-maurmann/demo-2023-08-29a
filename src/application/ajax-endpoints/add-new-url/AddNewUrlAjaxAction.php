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

use Pith\Framework\PithAction;

/**
 * Class AddNewUrlAjaxAction
 * @package WordDensityDemo\WordDensityApplication
 */
class AddNewUrlAjaxAction extends PithAction
{
    public function __construct(){
        // Set object dependencies
    }

    public function runAction()
    {
        $new_url_unsafe = $_REQUEST['new_url'] ?? '';

        // Call service object here

        $did_add_new_url = false;
        $is_successful   = false;

        // Build the response
        $response = [
            'message_status' => 'success',
            'action_status'  => $is_successful ? 'success' : 'failure',
            'data'           => [
                'did_add_new_url' => $did_add_new_url ? 'yes' : 'no',
            ],
        ];

        // Push to Preparer
        $this->prepare->response = $response;
    }
}