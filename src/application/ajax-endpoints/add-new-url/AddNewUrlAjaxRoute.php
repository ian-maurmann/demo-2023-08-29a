<?php

/**
 * Add New URL ajax route
 * ----------------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Ignore.
 * @noinspection PhpClassNamingConventionInspection    - Long class name is ok.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityApplication;

use Pith\Framework\PithRoute;

/**
 * Class AddNewUrlAjaxRoute
 * @package WordDensityDemo\WordDensityApplication
 */
class AddNewUrlAjaxRoute extends PithRoute
{
    public string $route_type   = 'endpoint';
    public string $pack         = '\\WordDensityDemo\\WordDensityApplication\\WordDensityApplicationPack';
    public string $access_level = 'world';
    public string $action       = '\\WordDensityDemo\\WordDensityApplication\\AddNewUrlAjaxAction';
    public string $view_adapter = '\\Pith\\JsonEndpointViewAdapter\\PithJsonEndpointViewAdapter';
}
