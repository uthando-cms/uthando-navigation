<?php

namespace UthandoNavigation\View;

use Zend\View\Helper\Navigation as ZendNavigation;

/**
 * Navigation
 */
class Navigation extends ZendNavigation
{
    /**
     * Default set of helpers to inject into the plugin manager
     *
     * @var array
     */
    protected $defaultPluginManagerHelpers = [
        'uthandoDbMenu' => 'UthandoNavigation\View\Navigation\DbMenu',
        'uthandoTbMenu' => 'UthandoNavigation\View\Navigation\TwitterBootstrapMenu',
    ];
    
    public function getAcl()
    {
    	if (!$this->hasAcl()) {
    		$acl = $this->getServiceLocator()
    		->getServiceLocator()
    		->get('UthandoUser\Service\Acl');
    		$this->setAcl($acl);
    	}
    
    	return parent::getAcl();
    }
    
    public function getRole()
    {
        if (!$this->hasRole()) {
            $identity = $this->view->plugin('identity');
            $role = ($identity()) ? $identity()->getRole() : 'guest';
            $this->setRole($role);
        }
        
        return parent::getRole();
    }

    /**
     * Retrieve plugin loader for navigation helpers
     *
     * Lazy-loads an instance of Navigation\HelperLoader if none currently
     * registered.
     *
     * @return \Zend\View\Helper\Navigation\PluginManager
     */
    public function getPluginManager()
    {
        $pm = parent::getPluginManager();
        
        foreach ($this->defaultPluginManagerHelpers as $name => $invokableClass) {
            $pm->setInvokableClass($name, $invokableClass);
        }
        
        return $pm;
    }
}
