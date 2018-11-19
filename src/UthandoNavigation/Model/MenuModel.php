<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Model
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Model;

use UthandoCommon\Model\Model;
use UthandoCommon\Model\ModelInterface;

/**
 * Class Menu
 * @package UthandoNavigation\Model
 */
class MenuModel implements ModelInterface
{
    use Model;
    
	/**
	 * @var int
	 */
	protected $menuId;
	
	/**
	 * @var string
	 */
	protected $menu;
	
	/**
	 * @return the $menuId
	 */
	public function getMenuId()
	{
		return $this->menuId;
	}

	/**
	 * @param number $menuId
	 */
	public function setMenuId($menuId)
	{
		$this->menuId = $menuId;
		return $this;
	}

	/**
	 * @return the $menu
	 */
	public function getMenu()
	{
		return $this->menu;
	}

	/**
	 * @param string $menu
	 */
	public function setMenu($menu)
	{
		$this->menu = $menu;
		return $this;
	}

}
