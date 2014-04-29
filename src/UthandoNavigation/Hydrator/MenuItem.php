<?php
namespace UthandoNavigation\Hydrator;

use UthandoCommon\Hydrator\AbstractHydrator;

class MenuItem extends AbstractHydrator
{
	protected $addDepth = false;
	
	/**
	 * @param \UthandoNavigation\Model\MenuItem $object
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
