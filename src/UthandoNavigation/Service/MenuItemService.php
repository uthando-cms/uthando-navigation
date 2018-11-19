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

use UthandoCommon\Mapper\AbstractNestedSet;
use UthandoCommon\Service\AbstractMapperService;
use UthandoCommon\Model\ModelInterface;
use UthandoNavigation\Form\MenuItemForm;
use UthandoNavigation\Hydrator\MenuItemHydrator;
use UthandoNavigation\InputFilter\MenuItemInputFilter;
use UthandoNavigation\Mapper\MenuItemMapper;
use UthandoNavigation\Model\MenuItemModel;
use Zend\Form\Form;
use Exception;

/**
 * Class MenuItem
 * @package UthandoNavigation\Service
 */
class MenuItemService extends AbstractMapperService
{
    protected $form         = MenuItemForm::class;
    protected $hydrator     = MenuItemHydrator::class;
    protected $inputFilter  = MenuItemInputFilter::class;
    protected $mapper       = MenuItemMapper::class;
    protected $model        = MenuItemModel::class;

    /**
     * @param $menuId
     * @param $label
     * @return mixed
     */
	public function getMenuItemByMenuIdAndLabel($menuId, $label)
	{
		$menuId = (int) $menuId;
		$label = (string) $label;
	
		return $this->getMapper()->getMenuItemByMenuIdAndLabel($menuId, $label);
	}

    /**
     * @param $id
     * @return mixed
     */
	public function getMenuItemsByMenuId($id)
	{
		$id = (int) $id;
		return $this->getMapper()->getMenuItemsByMenuId($id);
	}

    /**
     * @param $menu
     * @param bool $addDepth
     * @return mixed
     */
	public function getMenuItemsByMenu($menu, $addDepth=false)
	{
		$menu = (string) $menu;
		$result = $this->getMapper()->getMenuItemsByMenu($menu);
		
		if ($addDepth) {
            $result->getHydrator()->addDepth();
        }
        
        return $result;
	}

    /**
     * @param array $post
     * @return \Zend\Db\ResultSet\HydratingResultSet|\Zend\Db\ResultSet\ResultSet|\Zend\Paginator\Paginator
     */
	public function search(array $post)
	{
	    $menuId = (int) $post['menuId'];
	    unset($post['menuId']);
	    
	    $this->getMapper()->setMenuId($menuId);
	    
	    return parent::search($post);
	}

    /**
     * @param array $post
     * @param Form|null $form
     * @return Form
     */
	public function add(array $post, Form $form = null)
	{
		$menuItem = $this->getMapper()->getModel();
		$form  = $this->prepareForm($menuItem, $post, true, true);
		$position = (int) str_replace($post['menuId'] . '-', '', $post['position']);
		$insertType = (string) $post['menuInsertType'];
	
		if (!$form->isValid()) {
			return $form;
		}
		
		$data = $this->getMapper()->extract($form->getData());
		
		$pk = $this->getMapper()->getPrimaryKey();
		unset($data[$pk]);
		
		return $this->getMapper()->insertRow($data, $position, $insertType);
	}

    /**
     * @param ModelInterface $model
     * @param array $post
     * @param Form|null $form
     * @return mixed|Form
     * @throws Exception
     */
	public function edit(ModelInterface $model, array $post, Form $form = null)
	{
		$form  = $this->prepareForm($model, $post, true, true);
	
		if (!$form->isValid()) {
			return $form;
		}
		
		$menuItem = $this->getById($model->getMenuItemId());
        $this->removeCacheItem($model->getMenuItemId());
	
		if ($menuItem) {
			// if page position has changed then we need to delete it
			// and reinsert it in the new position else just update it.
			if (AbstractNestedSet::INSERT_NO !== $post['menuInsertType']) {
				// TODO find children and move them as well.
                $position = (int) str_replace($post['menuId'] . '-', '', $post['position']);
                $insertType = (string) $post['menuInsertType'];
                $data = $data = $this->getMapper()
                    ->extract($form->getData());
                $result = $this->getMapper()->move($data, $position, $insertType);
			} else {
				$data = $this->getMapper()->extract($form->getData());
				
				$pk = $this->getMapper()->getPrimaryKey();
				$id = $data[$pk];
				unset($data[$pk]);
				
				$result = $this->getMapper()->update($data, [$pk => $id]);
			}
		} else {
			throw new Exception('Menu Item id does not exist');
		}
	
		return $result;
	}
}
