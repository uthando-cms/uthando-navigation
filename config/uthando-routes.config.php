<?php

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'menu' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/menu',
                            'defaults' => [
                                '__NAMESPACE__' => 'UthandoNavigation\Controller',
                                'controller' => 'Menu',
                                'action' => 'index',
                                'force-ssl' => 'ssl'
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'edit' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/[:action[/id/[:id]]]',
                                    'constraints' => [
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'id' => '\d+'
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                        'force-ssl' => 'ssl'
                                    ],
                                ],
                            ],
                            'page' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/page/[:page]',
                                    'constraints' => [
                                        'page' => '\d+'
                                    ],
                                    'defaults' => [
                                        'action' => 'list',
                                        'page' => 1,
                                        'force-ssl' => 'ssl'
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'menu-item' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/menu-item[/menuId/[:menuId]]',
                            'constraints' => [
                                //'id' 		 => '\d+',
                                'menuId' => '\d+',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'UthandoNavigation\Controller',
                                'controller' => 'MenuItem',
                                'action' => 'index',
                                'force-ssl' => 'ssl'
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'edit' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/[:action[/id/[:id]]]',
                                    'constraints' => [
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        //'menuId' 	=> '\d+',
                                        'id' => '\d+'
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                        'force-ssl' => 'ssl'
                                    ],
                                ],
                            ],
                            'page' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/page/[:page]',
                                    'constraints' => [
                                        'page' => '\d+'
                                    ],
                                    'defaults' => [
                                        'action' => 'list',
                                        'page' => 1,
                                        'force-ssl' => 'ssl'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];