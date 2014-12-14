<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Form\Element
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Class RouteList
 * @package UthandoNavigation\Form\Element
 */
class RouteList extends Select implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    
    protected $emptyOption = '---Please select a Route---';
    
    public function init()
    {
        $config = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('config');
        
        $routes = $config['router']['routes'];
        $this->setValueOptions($this->getRoutes($routes));
    }
    
    public function getRoutes($routes)
    {
    	$routeArray = [0 => 'Category Heading'];
    	foreach($routes as $key => $val){
    		$routeArray[$key] = $key;
    		if (isset($val['child_routes'])) {
    			$routeArray = $this->getChildRoutes($routeArray, $key, $val['child_routes']);
    		}
    	}

    	return $routeArray;
    }
    
    protected function getChildRoutes($routeArray, $parent, $routes)
    {
    	foreach($routes as $key => $val){
            $key = $parent . '/' . $key;
    		$routeArray[$key] = $key;
    		if (isset($val['child_routes'])) {
                $routeArray = $this->getChildRoutes($routeArray, $key, $val['child_routes']);
    		}
    	}
    	 
    	return $routeArray;
    }
}
