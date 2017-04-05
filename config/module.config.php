<?php

use UthandoNavigation\Form\Element\MenuItemList;
use UthandoNavigation\Form\Element\MenuItemRadio;
use UthandoNavigation\Form\Element\ResourceList;
use UthandoNavigation\Form\Element\RouteList;
use UthandoNavigation\Form\Menu as MenuForm;
use UthandoNavigation\Form\MenuItem as MenuItemForm;
use UthandoNavigation\Hydrator\Menu as MenuHydrator;
use UthandoNavigation\Hydrator\MenuItem as MenuItemHydrator;
use UthandoNavigation\InputFilter\Menu as MenuInputFilter;
use UthandoNavigation\InputFilter\MenuItem as MenuItemInputFilter;
use UthandoNavigation\Mapper\Menu as MenuMapper;
use UthandoNavigation\Mapper\MenuItem as MenuItemmapper;
use UthandoNavigation\Model\Menu as MenuModel;
use UthandoNavigation\Model\MenuItem as MenuItemModel;
use UthandoNavigation\Mvc\Controller\MenuController;
use UthandoNavigation\Mvc\Controller\MenuItemController;
use UthandoNavigation\Mvc\Controller\SiteMapController;
use UthandoNavigation\Service\DbNavigationAbstractFactory;
use UthandoNavigation\Service\DbNavigationFactory;
use UthandoNavigation\Service\Menu;
use UthandoNavigation\Service\MenuItem;
use UthandoNavigation\Service\SiteMap;
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
    'form_elements' => [
        'invokables' => [
            'UthandoNavigationMenu'     => MenuForm::class,
            'UthandoNavigationMenuItem' => MenuItemForm::class,

            'MenuItemList'              => MenuItemList::class,
            'MenuItemRadio'             => MenuItemRadio::class,
            'ResourceList'              => ResourceList::class,
            'RouteList'                 => RouteList::class,
        ],
    ],
    'hydrators' => [
        'invokables' => [
            'UthandoNavigationMenu'     => MenuHydrator::class,
            'UthandoNavigationMenuItem' => MenuItemHydrator::class,
        ],
    ],
    'input_filters' => [
        'invokables' => [
            'UthandoNavigationMenu'     => MenuInputFilter::class,
            'UthandoNavigationMenuItem' => MenuItemInputFilter::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            'UthandoNavigation\DbNavigation' => DbNavigationFactory::class,
        ],
        'abstract_factories' => [
            DbNavigationAbstractFactory::class,
        ],
    ],
    'uthando_mappers' => [
        'invokables' => [
            'UthandoNavigationMenu'     => MenuMapper::class,
            'UthandoNavigationMenuItem' => MenuItemmapper::class,
        ],
    ],
    'uthando_models' => [
        'invokables' => [
            'UthandoNavigationMenu'     => MenuModel::class,
            'UthandoNavigationMenuItem' => MenuItemModel::class,
        ],
    ],
    'uthando_services' => [
        'invokables' => [
            'UthandoNavigationMenu'     => Menu::class,
            'UthandoNavigationMenuItem' => MenuItem::class,
            'UthandoNavigationSiteMap'  => SiteMap::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'UthandoNavigation' => NavigationFactory::class,
        ],
        'invokables' => [
            'NavigationForm'    => View\NavigationForm::class,
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
                        '__NAMESPACE__' => 'UthandoNavigation\Mvc\Controller',
                        'controller' => 'SiteMapController',
                        'action' => 'index',
                    ]
                ],
            ],
        ],
    ],
];
