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

use UthandoCommon\Mapper\AbstractNestedSet;
use Zend\Db\Sql\Select;

/**
 * Class MenuItem
 * @package UthandoNavigation\Mapper
 */
class MenuItem extends AbstractNestedSet
{
	protected $table = 'menuItem';
	protected $primary = 'menuItemId';

    /**
     * @var int
     */
	protected $menuId;

    /**
     * @param array $search
     * @param string $sort
     * @param Select $select
     * @return \Zend\Db\ResultSet\HydratingResultSet|\Zend\Db\ResultSet\ResultSet|\Zend\Paginator\Paginator
     */
	public function search(array $search, $sort, $select = null)
	{
	    $select = $this->getSelect();
	    $select->where->equalTo('menuId', $this->getMenuId());
	    
	    return parent::search($search, $sort, $select);
	}

    /**
     * @param int $id
     * @return \Zend\Db\ResultSet\HydratingResultSet|\Zend\Db\ResultSet\ResultSet|\Zend\Paginator\Paginator
     */
    public function getMenuItemsByMenuId($id)
    {   
        $select = $this->getFullTree();
        $select->reset('where');
        $select->where(['child.menuId' => $id]);
    	
    	return $this->fetchResult($select);
    }

    /**
     * @param int $menu
     * @return \Zend\Db\ResultSet\HydratingResultSet|\Zend\Db\ResultSet\ResultSet|\Zend\Paginator\Paginator
     */
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

    /**
     * @param int $menuId
     * @param string $label
     * @return \UthandoNavigation\Model\MenuItem|null
     */
    public function getMenuItemByMenuIdAndLabel($menuId, $label)
    {
    	$select = $this->getSelect()->where(['menuId' => $menuId, 'label' => $label]);
    	$rowSet = $this->fetchResult($select);
    	$row = $rowSet->current();
    	return $row;
    }

    /**
     * @param int $id
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function deleteMenuItemsByMenuId($id)
    {
    	$sql = $this->getSql();
    	$delete = $sql->delete($this->table);
    	
    	$delete->where(['menuId' => $id]);
    	
    	$statement = $sql->prepareStatementForSqlObject($delete);
    	
    	return $statement->execute();
    }
    
	/**
     * @return int
     */
    public function getMenuId ()
    {
        return $this->menuId;
    }

    /**
     * @param int $menuId
     * @return $this
     */
    public function setMenuId ($menuId)
    {
        $this->menuId = $menuId;
        return $this;
    }

}
