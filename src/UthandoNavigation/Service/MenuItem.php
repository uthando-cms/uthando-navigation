<?php
namespace UthandoNavigation\Service;

use UthandoCommon\Service\AbstractMapperService;
use UthandoCommon\Model\ModelInterface;
use Zend\Form\Form;
use Exception;

class MenuItem extends AbstractMapperService
{
    protected $serviceAlias = 'UthandoNavigationMenuItem';
	
	public function getMenuItemByMenuIdAndLabel($menuId, $label)
	{
		$menuId = (int) $menuId;
		$label = (string) $label;
	
		return $this->getMapper()->getMenuItemByMenuIdAndLabel($menuId, $label);
	}
	
	public function getMenuItemsByMenuId($id)
	{
		$id = (int) $id;
		return $this->getMapper()->getMenuItemsByMenuId($id);
	}
	
	public function getMenuItemsByMenu($menu, $addDepth=false)
	{
		$menu = (string) $menu;
		$result = $this->getMapper()->getMenuItemsByMenu($menu);
		
		if ($addDepth) {
            $result->getHydrator()->addDepth();
        }
        
        return $result;
	}
	
	public function search(array $post)
	{
	    $menuId = (int) $post['menuId'];
	    unset($post['menuId']);
	    
	    $this->getMapper()->setMenuId($menuId);
	    
	    return parent::search($post);
	}
	
	public function add(array $post, Form $form = null)
	{
		$menuItem = $this->getMapper()->getModel();
		$form  = $this->getForm($menuItem, $post, true, true);
		$position = (int) $post['position'];
		$insertType = (string) $post['menuInsertType'];
	
		if (!$form->isValid()) {
			return $form;
		}
		
		$data = $this->getMapper()->extract($form->getData());
		
		$pk = $this->getMapper()->getPrimaryKey();
		unset($data[$pk]);
		
		return $this->getMapper()->insertRow($data, $position, $insertType);
	}
    
	public function edit(ModelInterface $model, array $post, Form $form = null)
	{
		$form  = $this->getForm($model, $post, true, true);
	
		if (!$form->isValid()) {
			return $form;
		}
		
		$menuItem = $this->getById($model->getMenuItemId());
        $this->removeCacheItem($model->getMenuItemId());
	
		if ($menuItem) {
			// if page position has changed then we need to delete it
			// and reinsert it in the new position else just update it.
			if ('noInsert' !== $post['menuInsertType']) {
				// TODO find children and move them as well.
                $position = (int) $post['position'];
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
