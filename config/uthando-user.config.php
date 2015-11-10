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
];
