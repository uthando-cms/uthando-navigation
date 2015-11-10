<?php

return [
    'controllers' => [
        'invokables' => [
            'UthandoNavigation\Controller\Menu'       => 'UthandoNavigation\Mvc\Controller\MenuController',
            'UthandoNavigation\Controller\MenuItem'   => 'UthandoNavigation\Mvc\ontroller\MenuItemController',
        ],
    ],
    'form_elements' => [
        'invokables' => [
            'UthandoNavigationMenu'     => 'UthandoNavigation\Form\Menu',
            'UthandoNavigationMenuItem' => 'UthandoNavigation\Form\MenuItem',

            'MenuItemList'              => 'UthandoNavigation\Form\Element\MenuItemList',
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
            'UthandoNavigationMenuItem' => 'UthandoNavigation\Service\MenuItem'
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'NavigationForm'    => 'UthandoNavigation\View\NavigationForm',
            'UthandoNavigation' => 'UthandoNavigation\View\Navigation',
        ],
    ],
    'view_manager' => [
        'template_map' => include __DIR__  .'/../template_map.php',
    ],
];
