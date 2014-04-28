<?php

namespace UthandoNavigation\Service;

use UthandoCommon\Service\AbstractService;

class Menu extends AbstractService
{	
	protected $mapperClass = 'UthandoNavigation\Mapper\Menu';
	protected $form = 'UthandoNavigation\Form\Menu';
	protected $inputFilter = 'UthandoNavigation\InputFilter\Menu';
	
	public function getMenu($menuName)
	{
		$menuName = (string) $menuName;
		return $this->getMapper()->getMenu($menuName);
	}
}
