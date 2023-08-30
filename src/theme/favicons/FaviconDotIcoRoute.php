<?php

/**
 * favicon.ico Route
 * -----------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Ignore.
 * @noinspection PhpClassNamingConventionInspection    - Long class name is ok.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityTheme;

use Pith\Framework\PithRoute;

/**
 * Class FaviconDotIcoRoute
 * @package WordDensityDemo\WordDensityTheme
 */
class FaviconDotIcoRoute extends PithRoute
{
    public string $route_type    = 'resource-file';
    public string $pack          = 'WordDensityDemo\\WordDensityTheme\\WordDensityThemePack';
    public string $access_level  = 'world';
    public string $resource_path = '[^route_folder]/favicon-images/favicon.ico';
    public string $cache_level   = 'Cache-Control: public, max-age=31536000, immutable, stale-while-revalidate=604800, stale-if-error=1209600';
}
