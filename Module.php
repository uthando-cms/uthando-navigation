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
    	return include __DIR__ . '/config/controller.config.php';
    }
    
    public function getViewHelperConfig()
    {
    	return include __DIR__ . '/config/viewHelper.config.php';
    }
    
    public function getServiceConfig()
    {
    	return include __DIR__ . '/config/service.config.php';
    }
    
}
