<?php

/**
 * Main Layout route
 * -----------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Property names with underscores are ok.
 * @noinspection PhpClassNamingConventionInspection    - Long class names are ok.
 * @noinspection PhpIllegalPsrClassPathInspection      - Using PSR-4 not PSR-0.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityTheme;

use Pith\Framework\PithRoute;

/**
 * Class MainLayoutRoute
 * @package WordDensityDemo\WordDensityTheme
 */
class MainLayoutRoute extends PithRoute
{
    public string $pack             = 'WordDensityDemo\\WordDensityTheme\\WordDensityThemePack';
    public string $route_type       = 'layout';
    public string $access_level     = 'world';
    public string $view_requisition = '\\WordDensityDemo\\WordDensityTheme\\MainLayoutViewRequisition';
    public string $view             = '[^route_folder]/main-layout-view.latte';
}