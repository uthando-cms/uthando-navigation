<?php
namespace UthandoNavigation\Mapper;

use UthandoCommon\Mapper\AbstractDbMapper;

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
