<?php
namespace UthandoNavigation\Mapper;

use UthandoCommon\Mapper\AbstractNestedSet;

class Page extends AbstractNestedSet
{
	protected $table = 'page';
	protected $primary = 'pageId';
	protected $model = 'UthandoNavigation\Model\Page';
	protected $hydrator = 'UthandoNavigation\Hydrator\Page';
    
    public function getPagesByMenuId($id)
    {   
        $select = $this->getFullTree();
        $select->reset('where');
        $select->where(['child.menuId' => $id]);
    	
    	return $this->fetchResult($select);
    }
    
    public function getPagesByMenu($menu)
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
    
    public function getPageByMenuIdAndLabel($menuId, $label)
    {
    	$select = $this->getSelect()->where(['menuId' => $menuId, 'label' => $label]);
    	$rowSet = $this->fetchResult($select);
    	$row = $rowSet->current();
    	return $row;
    }
    
    public function deletePagesByMenuId($id)
    {
    	$sql = $this->getSql();
    	$delete = $sql->delete($this->table);
    	
    	$delete->where(['menuId' => $id]);
    	
    	$statement = $sql->prepareStatementForSqlObject($delete);
    	
    	return $statement->execute();
    }
}
