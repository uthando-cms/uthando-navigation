<?php
namespace UthandoNavigation\Hydrator;

use UthandoCommon\Hydrator\AbstractHydrator;

class Menu extends AbstractHydrator
{
	/**
	 * @param \UthandoNavigation\Model\Menu
	 * @return array
	 */
	public function extract($object)
	{
		return array(
			'menuId'	=> $object->getMenuId(),
			'menu'		=> $object->getMenu()
		);
	}
}
