<?php

/**
 * Get URLs ajax route
 * -------------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Ignore.
 * @noinspection PhpClassNamingConventionInspection    - Long class name is ok.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityApplication;

use Pith\Framework\PithRoute;

/**
 * Class GetUrlsAjaxRoute
 * @package WordDensityDemo\WordDensityApplication
 */
class GetUrlsAjaxRoute extends PithRoute
{
    public string $route_type   = 'endpoint';
    public string $pack         = '\\WordDensityDemo\\WordDensityApplication\\WordDensityApplicationPack';
    public string $access_level = 'world';
    public string $action       = '\\WordDensityDemo\\WordDensityApplication\\GetUrlsAjaxAction';
    public string $view_adapter = '\\Pith\\JsonEndpointViewAdapter\\PithJsonEndpointViewAdapter';
}
