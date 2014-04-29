<?php

namespace UthandoNavigation\Form;

use Zend\Form\Form;

class Menu extends Form
{
	public function __construct()
	{
		parent::__construct('Menu');
		
		$this->add([
			'name' => 'menuId',
			'type' => 'hidden',
		]);
		
		$this->add([
			'name' => 'menu',
			'type' => 'text',
			'options' => [
				'label' => 'Menu Title:',
				'required' => true,
			],
			'attributes' => [
				'placeholder' => 'Menu Title:',
			],
		]);
	}
}
