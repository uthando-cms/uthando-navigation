<?php

namespace UthandoNavigation\Form;

use Zend\Form\Form;

class MenuItem extends Form
{
	/**
	 * @var array
	 */
    protected $config;
    
    /**
     * @var \UthandoNavigation\Model\Mapper\MenuItem
     */
    protected $menuItemMapper;
    
	public function __construct()
	{
		parent::__construct('Menu Item');
	}
	
	public function init()
	{
		$this->add([
			'name' => 'menuItemId',
			'type' => 'hidden',
		]);
		
		$this->add([
			'name' => 'menuId',
			'type' => 'hidden',
		]);
		
		$this->add([
			'name' => 'label',
			'type' => 'text',
			'options' => [
				'label' => 'Label:',
				'required' => true,
			],
			'attributes' =>[
				'placeholder' => 'Label:',
			],
		]);
		
		$this->add([
			'name' => 'params',
			'type' => 'textarea',
			'options' => [
				'label' => 'Params:',
				'required' => false,
			],
			'attributes' => [
				'placeholder' => 'Params:',
			],
		]);
		
		$routes = $this->config['router']['routes'];
		
		$this->add([
			'name' => 'route',
			'type' => 'select',
			'options' => [
				'label' => 'Route:',
				'required' => false,
				'empty_option' => '---Please Select a Route---',
				'value_options' => $this->getRouteSelect($routes)
			],
		]);
		
		$resources = $this->config['userAcl']['userResources'];
		
		$this->add([
			'name' => 'resource',
			'type' => 'select',
			'options' => [
				'label' => 'Resource:',
				'required' => false,
				'empty_option' => 'None',
				'value_options' => $this->getResourceSelect($resources)
			],
			'attributes' => [
				'placeholder' => 'Resource:',
			],
		]);
		
		$this->add([
			'name' => 'visible',
			'type' => 'select',
			'options' => [
				'label' => 'Is Visible:',
				'required' => true,
				'empty_option' => '---Please select option---',
				'value_options' => [
					'0'	=> 'No',
					'1'	=> 'Yes',
				],
			],
		]);
	}
	
	public function setConfig($config)
	{
		$this->config = $config;
	}
	
	public function setMenuItemMapper($mapper)
	{
		$this->menuItemMapper = $mapper;
	}
	
	public function getMenuItemSelect($menuId)
	{    
	    $items = $this->menuItemMapper->getMenuItemsByMenuId($menuId);
	    $menuItemOptions = [];
	    
	    $menuItemOptions[0] = 'Add to top of menu';
	    
	    foreach($items as $item){
	        $menuItemOptions[$item->getMenuItemId()] = $item->getLabel();
	    }
	    
	    $this->add([
	        'name' => 'position',
	        'type' => 'select',
	        'options' => [
	            'label' => 'Location In Menu:',
	            'required' => true,
	            'empty_option' => '---Please Select a page---',
	            'value_options' => $menuItemOptions
	        ],
	    ]);
	    
	    return $this->get('position');
	}
	
	public function getResourceSelect($resources)
	{
	    $routeArray = [];
	    foreach($resources as $val){
	        $routeArray[$val] = $val;
	    }
	
	    return $routeArray;
	}
	
	public function getRouteSelect($routes)
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
	        $routeArray[$parent . '/' . $key] = $parent . '/' . $key;
	        if (isset($val['child_routes'])) {
	           
	        }
	    }
	    
	    return $routeArray;
	}
}
