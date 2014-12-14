<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Service;

use UthandoCommon\Service\AbstractMapperService;

/**
 * Class Menu
 * @package UthandoNavigation\Service
 */
class Menu extends AbstractMapperService
{	
	protected $serviceAlias = 'UthandoNavigationMenu';
	
	public function getMenu($menuName)
	{
		$menuName = (string) $menuName;
		return $this->getMapper()->getMenu($menuName);
	}
}
