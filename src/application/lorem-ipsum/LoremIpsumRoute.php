<?php

/**
 * Lorem Ipsum Route
 * -----------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Short property names are ok.
 * @noinspection PhpIllegalPsrClassPathInspection      - Using PSR-4 not PSR-0.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityApplication;

use Pith\Framework\PithRoute;

/**
 * Class LoremIpsumRoute
 * @package WordDensityDemo\WordDensityApplication
 */
class LoremIpsumRoute extends PithRoute
{
    public string $route_type   = 'page';
    public string $pack         = '\\WordDensityDemo\\WordDensityApplication\\WordDensityApplicationPack';
    public string $access_level = 'world';
    public string $view         = '[^route_folder]/lorem-ipsum.latte';

    public string $page_title       = 'lorem-ipsum- ' . PITH_DEMO_PAGE_MAIN_TITLE;
    public string $meta_keywords    = 'lorem-ipsum, demo, keyword, keywords';
    public string $meta_description = 'lorem-ipsum page description here.';
}
