<?php
namespace UthandoNavigation\Mapper;

use UthandoCommon\Mapper\AbstractMapper;

class Menu extends AbstractMapper
{
	protected $table = 'menu';
	protected $primary = 'menuId';
	protected $model = 'UthandoNavigation\Model\Menu';
	protected $hydrator = 'UthandoNavigation\Hydrator\Menu';
	
	public function getMenu($menu)
	{
	    $rowset = $this->getSelect()->where(['menu' => $menu]);
	    $row = $rowset->current();
	    return $row;
	}
}
