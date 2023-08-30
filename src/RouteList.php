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
        ['route-group', '',              PITH_DEMO_PAGES_ROUTE_GROUP_PATH,                   '\\Pith\\Framework\\SharedInfrastructure\\DemoPagesRouteList'],
        ['route-group', '',              PITH_ENV_INFO_PAGES_ROUTE_GROUP_PATH,               '\\Pith\\Framework\\SharedInfrastructure\\Pages\\EnvInfoPages\\EnvInfoRouteList'],
        ['route-group', '',              PITH_USER_SYSTEM_AJAX_ENDPOINTS_PATH,               '\\Pith\\Framework\\SharedInfrastructure\\Endpoints\\UserSystemAjaxEndpoints\\UserSystemAjaxEndpointsRouteList'],
        ['route',       'POST',          SHARED_UI_USER_LOGIN_FORM_ACTION_LINK,              '\\Pith\\Framework\\SharedInfrastructure\\Pages\\SharedUiPages\\PerformUserLoginRoute'],
        ['route',       ['GET', 'POST'], SHARED_UI_USER_PERFORM_LOGOUT_LINK,                 '\\Pith\\Framework\\SharedInfrastructure\\Pages\\SharedUiPages\\PerformUserLogoutRoute'],
        ['route',       ['GET', 'POST'], '/',                                                '\\WordDensityDemo\\WordDensityApplication\\DensityTestingRoute'],
        ['route',       ['GET', 'POST'], '/ajax/add-new-url',                                '\\WordDensityDemo\\WordDensityApplication\\AddNewUrlAjaxRoute'],
        ['route',       ['GET', 'POST'], '/default-landing',                                 '\\Pith\\Framework\\SharedInfrastructure\\DefaultLandingRoute'],
        ['route',       ['GET', 'POST'], '/error-403',                                       '\\Pith\\Framework\\SharedInfrastructure\\Error403Route'],
        ['route',       ['GET', 'POST'], '/error-404',                                       '\\Pith\\Framework\\SharedInfrastructure\\Error404Route'],
        ['route',       ['GET', 'POST'], '/error-405',                                       '\\Pith\\Framework\\SharedInfrastructure\\Error405Route'],
        ['route',       'GET',           '/favicon.ico',                                     '\\Pith\\Framework\\SharedUiResourcePack\\PithFrameworkLogoFaviconIcoRoute'],
        ['route',       ['GET', 'POST'], '/lorem-ipsum',                                     '\\WordDensityDemo\\WordDensityApplication\\LoremIpsumRoute'],
        ['route',       'GET',           '/resources/framework/shared-ui/{filepath:.+}',     '\\Pith\\Framework\\SharedUiResourcePack\\SharedUiApplicationResourceRoute'],
        ['route',       'GET',           '/resources/theme/{filepath:.+}',                   '\\WordDensityDemo\\WordDensityTheme\\ThemeResourceRoute'],
        ['route',       'GET',           '/resources/vendor/common-fonts/{filepath:.+}',     '\\Pith\\Framework\\CommonFontsResourcePack\\CommonFontsResourceRoute'],
        ['route',       'GET',           '/resources/vendor/common-libraries/{filepath:.+}', '\\Pith\\Framework\\CommonLibrariesResourcePack\\CommonLibrariesResourceRoute'],

    ];
}