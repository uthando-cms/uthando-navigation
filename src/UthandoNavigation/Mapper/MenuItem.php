<?php
namespace UthandoNavigation\Mapper;

use UthandoCommon\Mapper\AbstractNestedSet;
use Zend\Db\Sql\Select;

class MenuItem extends AbstractNestedSet
{
	protected $table = 'menuItem';
	protected $primary = 'menuItemId';
	protected $model = 'UthandoNavigation\Model\MenuItem';
	protected $hydrator = 'UthandoNavigation\Hydrator\MenuItem';
	protected $menuId;
	
	public function search(array $search, $sort, Select $select = null)
	{
	    $select = $this->getSelect();
	    $select->where->equalTo('menuId', $this->getMenuId());
	    
	    return parent::search($search, $sort, $select);
	}
    
    public function getMenuItemsByMenuId($id)
    {   
        $select = $this->getFullTree();
        $select->reset('where');
        $select->where(['child.menuId' => $id]);
    	
    	return $this->fetchResult($select);
    }
    
    public function getMenuItemsByMenu($menu)
    {
        $select = $this->getFullTree();
        $select->reset('where');
        $select->join(
        	'menu',
            'child.menuId = menu.menuId',
            []
        )->where(['menu.menu' => $menu]);
        
        return $this->fetchResult($select);
    }
    
    public function getMenuItemByMenuIdAndLabel($menuId, $label)
    {
    	$select = $this->getSelect()->where(['menuId' => $menuId, 'label' => $label]);
    	$rowSet = $this->fetchResult($select);
    	$row = $rowSet->current();
    	return $row;
    }
    
    public function deleteMenuItemsByMenuId($id)
    {
    	$sql = $this->getSql();
    	$delete = $sql->delete($this->table);
    	
    	$delete->where(['menuId' => $id]);
    	
    	$statement = $sql->prepareStatementForSqlObject($delete);
    	
    	return $statement->execute();
    }
    
	/**
     * @return the $menuId
     */
    public function getMenuId ()
    {
        return $this->menuId;
    }

	/**
     * @param field_type $menuId
     */
    public function setMenuId ($menuId)
    {
        $this->menuId = $menuId;
        return $this;
    }

}
