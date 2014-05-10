<?php

namespace UthandoNavigation;

class Module
{
	public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php'
            ],
        ];
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getControllerConfig()
    {
    	return [
        	'invokables' => [
        		'UthandoNavigation\Controller\Menu'       => 'UthandoNavigation\Controller\MenuController',
        		'UthandoNavigation\Controller\MenuItem'   => 'UthandoNavigation\Controller\MenuItemController',
        	],
        ];
    }
    
    public function getViewHelperConfig()
    {
    	return [
        	'invokables' => [
        		'NavigationForm'      => 'UthandoNavigation\View\NavigationForm',
        		'uthandoNavigation'   => 'UthandoNavigation\View\Navigation',
        	],
        ];
    }
    
    public function getServiceConfig()
    {
    	return [
            'invokables' => [
                'UthandoNavigation\InputFilter\Menu'        => 'UthandoNavigation\InputFilter\Menu',
                'UthandoNavigation\InputFilter\MenuItem'    => 'UthandoNavigation\InputFilter\MenuItem',
                'UthandoNavigation\Mapper\Menu'             => 'UthandoNavigation\Mapper\Menu',
                'UthandoNavigation\Mapper\MenuItem'         => 'UthandoNavigation\Mapper\MenuItem',
                'UthandoNavigation\Service\Menu'            => 'UthandoNavigation\Service\Menu',
                'UthandoNavigation\Service\MenuItem'        => 'UthandoNavigation\Service\MenuItem'
            ],
        ];
    }
    
    public function getFormElementConfig()
    {
    	return [
			'invokables' => [
                'MenuItemList'  => 'UthandoNavigation\Form\Element\MenuItemList',
                'ResourceList'  => 'UthandoNavigation\Form\Element\ResourceList',
				'RouteList'     => 'UthandoNavigation\Form\Element\RouteList',
			],
    	];
    }
    
}
