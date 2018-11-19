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
 * Class MenuItem
 * @package UthandoNavigation\Hydrator
 */
class MenuItemHydrator extends AbstractHydrator
{
	protected $addDepth = false;
	
	/**
	 * @param \UthandoNavigation\Model\MenuItemModel $object
	 * @return array $data
	 */
	public function extract($object)
	{
		$data = [
			'menuItemId' => $object->getMenuItemId(),
			'menuId'     => $object->getMenuId(),
			'label'		 => $object->getLabel(),
			'params'	 => $object->getParams(),
			'route'		 => $object->getRoute(),
			'uri'		 => $object->getUri(),
			'resource'	 => $object->getResource(),
			'visible'	 => $object->getVisible(),
			'lft'		 => $object->getLft(),
			'rgt'		 => $object->getRgt()
		];
		
		if (true === $this->addDepth) {
			$data['depth'] = $object->getDepth();
		}
		
		return $data;
	}
	
	public function addDepth()
	{
		$this->addDepth = true;
	}
}
