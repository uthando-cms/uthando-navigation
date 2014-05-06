<?php

return [
    'UthandoNavigation\Module'                                  => __DIR__ . '/Module.php',
    
    'UthandoNavigation\Controller\MenuController'               => __DIR__ . '/src/UthandoNavigation/Controller/MenuController.php',
    'UthandoNavigation\Controller\MenuItemController'           => __DIR__ . '/src/UthandoNavigation/Controller/MenuItemController.php',
    
    'UthandoNavigation\Form\Menu'                               => __DIR__ . '/src/UthandoNavigation/Form/Menu.php',
    'UthandoNavigation\Form\MenuItem'                           => __DIR__ . '/src/UthandoNavigation/Form/MenuItem.php',
    
    'UthandoNavigation\Hydrator\Menu'                           => __DIR__ . '/src/UthandoNavigation/Hydrator/Menu.php',
    'UthandoNavigation\Hydrator\MenuItem'                       => __DIR__ . '/src/UthandoNavigation/Hydrator/MenuItem.php',
    
    'UthandoNavigation\InputFilter\Menu'                        => __DIR__ . '/src/UthandoNavigation/InputFilter/Menu.php',
    'UthandoNavigation\InputFilter\MenuItem'                    => __DIR__ . '/src/UthandoNavigation/InputFilter/MenuItem.php',
    
    'UthandoNavigation\Mapper\Menu'                             => __DIR__ . '/src/UthandoNavigation/Mapper/Menu.php',
    'UthandoNavigation\Mapper\MenuItem'                         => __DIR__ . '/src/UthandoNavigation/Mapper/MenuItem.php',
    
    'UthandoNavigation\Model\Menu'                              => __DIR__ . '/src/UthandoNavigation/Model/Menu.php',
    'UthandoNavigation\Model\MenuItem'                          => __DIR__ . '/src/UthandoNavigation/Model/MenuItem.php',
    
    'UthandoNavigation\Service\Form\MenuItemFactory'            => __DIR__ . '/src/UthandoNavigation/Service/Form/MenuItemFactory.php',
    'UthandoNavigation\Service\Menu'                            => __DIR__ . '/src/UthandoNavigation/Service/Menu.php',
    'UthandoNavigation\Service\MenuItem'                        => __DIR__ . '/src/UthandoNavigation/Service/MenuItem.php',
    
    'UthandoNavigation\View\NavigationForm'                     => __DIR__ . '/src/UthandoNavigation/View/NavigationForm.php',
    'UthandoNavigation\View\Navigation'                         => __DIR__ . '/src/UthandoNavigation/View/Navigation.php',
    'UthandoNavigation\View\Navigation\DbMenu'                  => __DIR__ . '/src/UthandoNavigation/View/Navigation/DbMenu.php',
    'UthandoNavigation\View\Navigation\TwitterBootstrapMenu'    => __DIR__ . '/src/UthandoNavigation/View/Navigation/TwitterBootstrapMenu.php',
];
