<?php

use UthandoNavigation\Controller\MenuController;
use UthandoNavigation\Controller\MenuItemController;
use UthandoNavigation\Controller\SiteMapController;
use UthandoNavigation\Service\DbNavigationAbstractFactory;
use UthandoNavigation\Service\DbNavigationFactory;
use UthandoNavigation\Service\MenuService;
use UthandoNavigation\Service\MenuItemService;
use UthandoNavigation\Service\SiteMapService;
use UthandoNavigation\View;
use UthandoNavigation\View\Service\NavigationFactory;

return [
    'controllers' => [
        'invokables' => [
            MenuController::class       => MenuController::class,
            MenuItemController::class   => MenuItemController::class,
            SiteMapController::class    => SiteMapController::class,
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'UthandoNavigation\DbNavigation' => View\Navigation::class,
        ],
        'factories' => [
            View\Navigation::class => DbNavigationFactory::class,
        ],
        'abstract_factories' => [
            DbNavigationAbstractFactory::class,
        ],
    ],
    'uthando_services' => [
        'invokables' => [
            MenuService::class     => MenuService::class,
            MenuItemService::class => MenuItemService::class,
            SiteMapService::class  => SiteMapService::class,
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'navigationForm'    => View\NavigationForm::class,
            'uthandoNavigation' => View\Navigation::class,
        ],
        'factories' => [
            View\Navigation::class => NavigationFactory::class,
        ],
        'invokables' => [
            View\NavigationForm::class    => View\NavigationForm::class,
        ],
    ],
    'view_manager' => [
        'template_map' => include __DIR__  .'/../template_map.php',
    ],
    'router' => [
        'routes' => [
            'site-map' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/sitemap.xml',
                    'defaults' => [
                        '__NAMESPACE__' => 'UthandoNavigation\Controller',
                        'controller' => SiteMapController::class,
                        'action' => 'index',
                    ]
                ],
            ],
        ],
    ],
];
