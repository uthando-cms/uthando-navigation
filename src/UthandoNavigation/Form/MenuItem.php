<?php

namespace UthandoNavigation\Form;

use Zend\Form\Form;

class MenuItem extends Form
{
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
		
		$this->add([
			'name' => 'route',
			'type' => 'RouteList',
			'options' => [
				'label' => 'Route:',
				'required' => false,
			],
		]);
		
		$this->add([
			'name' => 'resource',
			'type' => 'ResourceList',
			'options' => [
				'label' => 'Resource:',
				'required' => false,
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
		
		$this->add([
			'name' => 'position',
			'type' => 'MenuItemList',
			'options' => [
                'label'     => 'Location In Menu:',
                'required'  => true,
			],
		]);
	}
}
