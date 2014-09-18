<?php

namespace UthandoNavigation\Service;

use UthandoCommon\Service\AbstractMapperService;

class Menu extends AbstractMapperService
{	
	protected $serviceAlias = 'UthandoNavigationMenu';
	
	public function getMenu($menuName)
	{
		$menuName = (string) $menuName;
		return $this->getMapper()->getMenu($menuName);
	}
}
