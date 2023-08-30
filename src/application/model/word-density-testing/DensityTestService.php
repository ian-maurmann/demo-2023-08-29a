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

}