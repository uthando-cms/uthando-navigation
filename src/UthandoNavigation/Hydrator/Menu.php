<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Hydrator
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Hydrator;

use UthandoCommon\Hydrator\AbstractHydrator;

/**
 * Class Menu
 * @package UthandoNavigation\Hydrator
 */
class Menu extends AbstractHydrator
{
	/**
	 * @param \UthandoNavigation\Model\Menu
	 * @return array
	 */
	public function extract($object)
	{
		return [
			'menuId'	=> $object->getMenuId(),
			'menu'		=> $object->getMenu()
		];
	}
}
