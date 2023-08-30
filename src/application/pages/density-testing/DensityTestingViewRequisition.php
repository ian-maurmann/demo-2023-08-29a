<?php

/**
 * Density Testing view-requisition
 * ----------------------------
 *
 * @noinspection PhpClassNamingConventionInspection    - Long class names are ok.
 * @noinspection PhpPropertyNamingConventionInspection - Property names with underscores are ok.
 * @noinspection PhpMissingParentCallCommonInspection  - Preparer parent methods exist as fallback.
 * @noinspection PhpIllegalPsrClassPathInspection      - Using PSR-4 not PSR-0.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityApplication;

use Pith\Framework\PithViewRequisition;

/**
 * Class DensityTestingViewRequisition
 * @package WordDensityDemo\WordDensityApplication
 */
class DensityTestingViewRequisition extends PithViewRequisition
{
    public string $requisition_type = 'layout-view-requisition';

    public function runRequisition()
    {
        // JS Libraries for page
        $this->addScript('Word-Density-widget script', '/resources/theme/word-density-widget.js', 'application-for-page');
    }
}