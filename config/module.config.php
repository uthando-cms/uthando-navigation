<?php

return [
    'controllers' => [
        'invokables' => [
            'UthandoNavigation\Controller\Menu'       => 'UthandoNavigation\Mvc\Controller\MenuController',
            'UthandoNavigation\Controller\MenuItem'   => 'UthandoNavigation\Mvc\Controller\MenuItemController',
            'UthandoNavigation\Controller\SiteMap'    => 'UthandoNavigation\Mvc\Controller\SiteMapController',
        ],
    ],
    'form_elements' => [
        'invokables' => [
            'UthandoNavigationMenu'     => 'UthandoNavigation\Form\Menu',
            'UthandoNavigationMenuItem' => 'UthandoNavigation\Form\MenuItem',

            'MenuItemList'              => 'UthandoNavigation\Form\Element\MenuItemList',
            'MenuItemRadio'             => 'UthandoNavigation\Form\Element\MenuItemRadio',
            'ResourceList'              => 'UthandoNavigation\Form\Element\ResourceList',
            'RouteList'                 => 'UthandoNavigation\Form\Element\RouteList',
        ],
    ],
    'hydrators' => [
        'invokables' => [
            'UthandoNavigationMenu'     => 'UthandoNavigation\Hydrator\Menu',
            'UthandoNavigationMenuItem' => 'UthandoNavigation\Hydrator\MenuItem',
        ],
    ],
    'input_filters' => [
        'invokables' => [
            'UthandoNavigationMenu'     => 'UthandoNavigation\InputFilter\Menu',
            'UthandoNavigationMenuItem' => 'UthandoNavigation\InputFilter\MenuItem',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'UthandoNavigation\DbNavigation' => 'UthandoNavigation\Service\Factory\DbNavigationFactory',
        ],
        'abstract_factories' => [
            'UthandoNavigation\Service\DbNavigationAbstractFactory',
        ],
    ],
    'uthando_mappers' => [
        'invokables' => [
            'UthandoNavigationMenu'     => 'UthandoNavigation\Mapper\Menu',
            'UthandoNavigationMenuItem' => 'UthandoNavigation\Mapper\MenuItem',
        ],
    ],
    'uthando_models' => [
        'invokables' => [
            'UthandoNavigationMenu'     => 'UthandoNavigation\Model\Menu',
            'UthandoNavigationMenuItem' => 'UthandoNavigation\Model\MenuItem',
        ],
    ],
    'uthando_services' => [
        'invokables' => [
            'UthandoNavigationMenu'     => 'UthandoNavigation\Service\Menu',
            'UthandoNavigationMenuItem' => 'UthandoNavigation\Service\MenuItem',
            'UthandoNavigationSiteMap'  => 'UthandoNavigation\Service\SiteMap',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'UthandoNavigation' => 'UthandoNavigation\View\Service\NavigationFactory',
        ],
        'invokables' => [
            'NavigationForm'    => 'UthandoNavigation\View\NavigationForm',
            //'UthandoNavigation' => 'UthandoNavigation\View\Navigation',
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
                        'controller' => 'SiteMap',
                        'action' => 'index',
                    ]
                ],
            ],
        ],
    ],
];
