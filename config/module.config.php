<?php

return [
	'userAcl' => [
		'userRoles' => [
			'admin' => [
				'privileges' => [
					['controller' => 'UthandoNavigation\Controller\Menu', 'action' => 'all'],
					['controller' => 'UthandoNavigation\Controller\Page', 'action' => 'all'],
				],
			],
		],
		'userResources' => [
			'UthandoNavigation\Controller\Menu',
			'UthandoNavigation\Controller\Page',
			'menu:admin', 'menu:guest', 'menu:user',
		],
	],
    'router' => [
        'routes' => [
        	'admin' => [
        		'child_routes' => [
        			'menu' => [
        				'type'    => 'Segment',
        				'options' => [
        					'route'    => '/menu[/:action[/id/[:id]]]',
        					'constraints' => [
        						'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
        						'id' 		 => '\d+'
        					],
        					'defaults' => [
        						'__NAMESPACE__' => 'UthandoNavigation\Controller',
        						'controller'    => 'Menu',
        						'action'        => 'list',
        					    'force-ssl'     => 'ssl'
        					],
        				],
        			],
        			'page' => [
        				'type'    => 'Segment',
        				'options' => [
        					'route'    => '/page[/:action[/menuId/[:menuId]][/id/[:id]]]',
        					'constraints' => [
        						'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
        						'id' 		 => '\d+',
        						'menuId' 	 => '\d+'
        					],
        					'defaults' => [
        						'__NAMESPACE__' => 'UthandoNavigation\Controller',
        						'controller'    => 'Page',
        						'action'        => 'list',
        					    'force-ssl'     => 'ssl'
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
            			'route'      => 'admin/menu',
            			'resource'   => 'menu:admin'
            		],
            	],
            	'route' => 'admin/menu',
            	'resource' => 'menu:admin'
			],
		],
	],
    'view_manager' => [
    	'template_map' => include __DIR__  .'/../template_map.php',
    ],
];
