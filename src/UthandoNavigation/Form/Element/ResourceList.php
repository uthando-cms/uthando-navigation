<?php
namespace UthandoNavigation\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class ResourceList extends Select implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    
    protected $emptyOption = 'None';
    
    public function init()
    {
        $config = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('config');
        
        $resources = $config['userAcl']['userResources'];
        $this->setValueOptions($this->getResources($resources));
    }
    
    public function getResources($resources)
    {
    	$routeArray = [];
    	
    	foreach($resources as $val) {
    	    
    		$routeArray[$val] = $val;
    	}
    
    	return $routeArray;
    }
}
