<?php

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'guest' => [
                    'privileges' => [
                        'allow' => [
                            'resources' => ['menu:guest'],
                        ],
                    ],
                ],
                'registered' => [
                    'privileges' => [
                        'deny' => [
                            'resources' => ['menu:guest'],
                        ],
                        'allow' => [
                            'resources' => ['menu:user'],
                        ],
                    ],
                ],
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                'UthandoNavigation\Controller\Menu' => ['action' => 'all'],
                                'UthandoNavigation\Controller\MenuItem' => ['action' => 'all'],
                            ],
                            'resources' => ['menu:admin'],
                        ],
                    ],
                ],
            ],
            'resources' => [
                'UthandoNavigation\Controller\Menu',
                'UthandoNavigation\Controller\MenuItem',
                'menu:admin',
                'menu:guest',
                'menu:user',
            ],
        ],
	],
    'controllers' => [
        'invokables' => [
            'UthandoNavigation\Controller\Menu'       => 'UthandoNavigation\Controller\MenuController',
            'UthandoNavigation\Controller\MenuItem'   => 'UthandoNavigation\Controller\MenuItemController',
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
    'router' => [
        'routes' => [
        	'admin' => [
        		'child_routes' => [
        			'menu' => [
        				'type'    => 'Segment',
        				'options' => [
        					'route'    => '/menu',
        					'defaults' => [
        						'__NAMESPACE__' => 'UthandoNavigation\Controller',
        						'controller'    => 'Menu',
        						'action'        => 'index',
        					    'force-ssl'     => 'ssl'
        					],
        				],
        				'may_terminate' => true,
        				'child_routes' => [
        				    'edit' => [
        				        'type'    => 'Segment',
    				            'options' => [
        				            'route'         => '/[:action[/id/[:id]]]',
        				            'constraints'   => [
        				                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
        				                'id'		=> '\d+'
        				            ],
        				            'defaults'      => [
        				                'action'        => 'edit',
        				                'force-ssl'     => 'ssl'
				                    ],
                                ],
			                ],
			                'page' => [
				                'type'    => 'Segment',
				                'options' => [
    				                'route'         => '/page/[:page]',
    				                'constraints'   => [
        								'page'			=> '\d+'
							        ],
							        'defaults'      => [
								        'action'        => 'list',
								        'page'          => 1,
								        'force-ssl'     => 'ssl'
					                ],
				                ],
			                ],
                        ],
        			],
        			'menu-item' => [
        				'type'    => 'Segment',
        				'options' => [
        					'route'    => '/menu-item[/menuId/[:menuId]]',
        					'constraints' => [
        						//'id' 		 => '\d+',
        						'menuId' 	 => '\d+',
        					],
        					'defaults' => [
        						'__NAMESPACE__' => 'UthandoNavigation\Controller',
        						'controller'    => 'MenuItem',
        						'action'        => 'index',
        					    'force-ssl'     => 'ssl'
        					],
        				],
        				'may_terminate' => true,
        				'child_routes' => [
        				    'edit' => [
        				        'type'    => 'Segment',
        				        'options' => [
        				            'route'         => '/[:action[/id/[:id]]]',
        				            'constraints'   => [
        				                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
        				                //'menuId' 	=> '\d+',
    				                    'id'		=> '\d+'
        				            ],
        				            'defaults'      => [
        				                'action'        => 'edit',
        				                'force-ssl'     => 'ssl'
    				                ],
				                ],
			                ],
			                'page' => [
				                'type'    => 'Segment',
				                'options' => [
    				                'route'         => '/page/[:page]',
    				                'constraints'   => [
        								'page'			=> '\d+'
							        ],
							        'defaults'      => [
								        'action'        => 'list',
								        'page'          => 1,
								        'force-ssl'     => 'ssl'
					                ],
				                ],
			                ],
		                ],
        			],
        		],
        	],
        ],
    ],
	'navigation' => [
		'admin' => [
			'menu' => [
            	'label' => 'Menu',
            	'pages' => [
            		'list' => [
            			'label'      => 'List All Menus',
            			'action'     => 'list',
            			'route'      => 'admin/menu',
            			'resource'   => 'menu:admin'
            		],
            		'add' => [
            			'label'      => 'Add New Menu',
            			'action'     => 'add',
            			'route'      => 'admin/menu/edit',
            			'resource'   => 'menu:admin'
            		],
            	],
            	'route' => 'admin/menu',
            	'resource' => 'menu:admin'
			],
		],
	],
];
