<?php

/**
 * Density Testing Route
 * ---------------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Short property names are ok.
 * @noinspection PhpIllegalPsrClassPathInspection      - Using PSR-4 not PSR-0.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityApplication;

use Pith\Framework\PithRoute;

/**
 * Class DensityTestingRoute
 * @package WordDensityDemo\WordDensityApplication
 */
class DensityTestingRoute extends PithRoute
{
    public string $route_type   = 'page';
    public string $pack         = '\\WordDensityDemo\\WordDensityApplication\\WordDensityApplicationPack';
    public string $access_level = 'world';
    public string $view         = '[^route_folder]/density-testing.latte';
    public string $layout       = '\\WordDensityDemo\\WordDensityTheme\\MainLayoutRoute';

    public string $page_title       = WORD_DENSITY_APP_MAIN_TITLE;
    public string $meta_keywords    = 'density testing, demo, keyword, keywords';
    public string $meta_description = 'Density testing page description here.';
}
