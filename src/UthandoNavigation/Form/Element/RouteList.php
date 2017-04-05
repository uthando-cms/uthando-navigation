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

    /**
     * @var string
     */
    protected $emptyOption = '---Please select a Route---';

    /**
     * init
     */
    public function init()
    {
        $config = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('config');
        
        $routes = $config['router']['routes'];
        $this->setValueOptions($this->getRoutes($routes));
    }

    /**
     * @param $routes
     * @return array
     */
    public function getRoutes($routes)
    {
    	$routeArray = [
    	    'heading'   => 'Category Heading',
            'link'      => 'Link'
        ];

    	foreach($routes as $key => $val){
    		$routeArray[$key] = $key;
    		if (isset($val['child_routes'])) {
    			$routeArray = $this->getChildRoutes($routeArray, $key, $val['child_routes']);
    		}
    	}

    	return $routeArray;
    }

    /**
     * @param $routeArray
     * @param $parent
     * @param $routes
     * @param int $depth
     * @return mixed
     */
    protected function getChildRoutes($routeArray, $parent, $routes, $depth = 1)
    {
        if ($parent != 'admin') {
            foreach($routes as $key => $val){
                $key = $parent . ' : ' . $key;
                $routeArray[$key] = $key;
                if (isset($val['child_routes'])) {
                    $routeArray = $this->getChildRoutes($routeArray, $key, $val['child_routes'], $depth++);
                }
            }
        }
    	 
    	return $routeArray;
    }
}
