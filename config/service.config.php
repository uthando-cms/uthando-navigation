<?php
return [
    'shared' => [
        'UthandoNavigation\Form\Menu'               => false,
        'UthandoNavigation\Form\MenuItem'           => false
    ],
    'invokables' => [
        'UthandoNavigation\Form\Menu'               => 'UthandoNavigation\Form\Menu',
        
        'UthandoNavigation\InputFilter\Menu'        => 'UthandoNavigation\InputFilter\Menu',
        'UthandoNavigation\InputFilter\MenuItem'    => 'UthandoNavigation\InputFilter\MenuItem',
        
        'UthandoNavigation\Mapper\Menu'             => 'UthandoNavigation\Mapper\Menu',
        'UthandoNavigation\Mapper\MenuItem'         => 'UthandoNavigation\Mapper\MenuItem',
        
        'UthandoNavigation\Service\Menu'            => 'UthandoNavigation\Service\Menu',
        'UthandoNavigation\Service\MenuItem'        => 'UthandoNavigation\Service\MenuItem'
    ],
    'factories' => [
        'UthandoNavigation\Form\MenuItem'           => 'UthandoNavigation\Service\Form\MenuItemFactory'
    ]
];
