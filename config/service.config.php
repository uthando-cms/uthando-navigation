<?php
return [
    'shared' => [
        'UthandoNavigation\Form\Menu'           => false,
        'UthandoNavigation\Form\Page'           => false
    ],
    'invokables' => [
        'UthandoNavigation\Form\Menu'           => 'UthandoNavigation\Form\Menu',
        
        'UthandoNavigation\InputFilter\Menu'    => 'UthandoNavigation\InputFilter\Menu',
        'UthandoNavigation\InputFilter\Page'    => 'UthandoNavigation\InputFilter\Page',
        
        'UthandoNavigation\Mapper\Menu'         => 'UthandoNavigation\Mapper\Menu',
        'UthandoNavigation\Mapper\Page'         => 'UthandoNavigation\Mapper\Page',
        
        'UthandoNavigation\Service\Menu'        => 'UthandoNavigation\Service\Menu',
        'UthandoNavigation\Service\Page'        => 'UthandoNavigation\Service\Page'
    ],
    'factories' => [
        'UthandoNavigation\Form\Page'           => 'UthandoNavigation\Service\Form\PageFactory'
    ]
];
