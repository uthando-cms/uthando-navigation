<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Mapper
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Mapper;

use UthandoCommon\Mapper\AbstractDbMapper;

/**
 * Class Menu
 * @package UthandoNavigation\Mapper
 */
class Menu extends AbstractDbMapper
{
	protected $table = 'menu';
	protected $primary = 'menuId';

    /**
     * @param int $menu
     * @return null|\UthandoNavigation\Model\Menu
     */
	public function getMenu($menu)
	{
	    $select = $this->getSelect()->where(['menu' => $menu]);
        $rowSet = $this->fetchResult($select);
	    $row = $rowSet->current();
	    return $row;
	}
}
