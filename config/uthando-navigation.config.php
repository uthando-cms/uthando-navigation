<?php

return [
    'navigation' => [
        'admin' => [
            'menu' => [
                'label' => 'Menu',
                'params' => [
                    'icon' => 'fa-bars',
                ],
                'pages' => [
                    'list' => [
                        'label'      => 'List All Menus',
                        'action'     => 'list',
                        'route'      => 'admin/menu',
                        'resource'   => 'menu:admin',
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
