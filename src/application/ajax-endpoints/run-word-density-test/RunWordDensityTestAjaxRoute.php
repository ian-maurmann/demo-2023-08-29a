<?php

/**
 * Run Word Density Test ajax route
 * --------------------------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Ignore.
 * @noinspection PhpClassNamingConventionInspection    - Long class name is ok.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityApplication;

use Pith\Framework\PithRoute;

/**
 * Class RunWordDensityTestAjaxRoute
 * @package WordDensityDemo\WordDensityApplication
 */
class RunWordDensityTestAjaxRoute extends PithRoute
{
    public string $route_type   = 'endpoint';
    public string $pack         = '\\WordDensityDemo\\WordDensityApplication\\WordDensityApplicationPack';
    public string $access_level = 'world';
    public string $action       = '\\WordDensityDemo\\WordDensityApplication\\RunWordDensityTestAjaxAction';
    public string $view_adapter = '\\Pith\\JsonEndpointViewAdapter\\PithJsonEndpointViewAdapter';
}
