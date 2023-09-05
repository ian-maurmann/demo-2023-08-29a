<?php

/**
 * Route List
 * ----------
 *
 * @noinspection PhpClassNamingConventionInspection - Long class names are ok.
 */


declare(strict_types=1);


namespace WordDensityDemo;

use Pith\Framework\PithRouteList;

/**
 * Class DemoAppRouteList
 * @package WordDensityDemo
 */
class RouteList extends PithRouteList
{
    public array $routes = [
        ['route',       ['GET', 'POST'], '/',                                                '\\WordDensityDemo\\WordDensityApplication\\DensityTestingRoute'],
        ['route',       ['GET', 'POST'], '/ajax/add-new-url',                                '\\WordDensityDemo\\WordDensityApplication\\AddNewUrlAjaxRoute'],
        ['route',       ['GET', 'POST'], '/ajax/get-url-test-words',                         '\\WordDensityDemo\\WordDensityApplication\\GetUrlTestWordsAjaxRoute'],
        ['route',       ['GET', 'POST'], '/ajax/get-url-tests',                              '\\WordDensityDemo\\WordDensityApplication\\GetUrlTestsAjaxRoute'],
        ['route',       ['GET', 'POST'], '/ajax/get-urls',                                   '\\WordDensityDemo\\WordDensityApplication\\GetUrlsAjaxRoute'],
        ['route',       ['GET', 'POST'], '/ajax/run-word-density-test',                      '\\WordDensityDemo\\WordDensityApplication\\RunWordDensityTestAjaxRoute'],
        ['route',       ['GET', 'POST'], '/error-403',                                       '\\Pith\\Framework\\SharedInfrastructure\\Error403Route'],
        ['route',       ['GET', 'POST'], '/error-404',                                       '\\Pith\\Framework\\SharedInfrastructure\\Error404Route'],
        ['route',       ['GET', 'POST'], '/error-405',                                       '\\Pith\\Framework\\SharedInfrastructure\\Error405Route'],
        ['route',       'GET',           '/favicon.ico',                                     '\\WordDensityDemo\\WordDensityTheme\\FaviconDotIcoRoute'],
        ['route',       ['GET', 'POST'], '/lorem-ipsum',                                     '\\WordDensityDemo\\WordDensityApplication\\LoremIpsumRoute'],
        ['route',       'GET',           '/resources/theme/{filepath:.+}',                   '\\WordDensityDemo\\WordDensityTheme\\ThemeResourceRoute'],
        ['route',       'GET',           '/resources/vendor/common-fonts/{filepath:.+}',     '\\Pith\\Framework\\CommonFontsResourcePack\\CommonFontsResourceRoute'],
        ['route',       'GET',           '/resources/vendor/common-libraries/{filepath:.+}', '\\Pith\\Framework\\CommonLibrariesResourcePack\\CommonLibrariesResourceRoute'],

    ];
}