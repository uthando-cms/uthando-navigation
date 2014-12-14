<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Form
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Form;

use Zend\Form\Form;

/**
 * Class Menu
 * @package UthandoNavigation\Form
 */
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
