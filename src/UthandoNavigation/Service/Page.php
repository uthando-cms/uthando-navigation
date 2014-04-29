<?php
namespace UthandoNavigation\Service;

use UthandoCommon\Service\AbstractService;
use UthandoNavigation\Model\Page as PageModel;
use Exception;

class Page extends AbstractService
{
	protected $mapperClass = 'UthandoNavigation\Mapper\Page';
	protected $form = 'UthandoNavigation\Form\Page';
	protected $inputFilter = 'UthandoNavigation\InputFilter\Page';
	
	public function getPageByMenuIdAndLabel($menuId, $label)
	{
		$menuId = (int) $menuId;
		$label = (string) $label;
	
		return $this->getMapper()->getPageByMenuIdAndLabel($menuId, $label);
	}
	
	public function getPagesByMenuId($id)
	{
		$id = (int) $id;
		return $this->getMapper()->getPagesByMenuId($id);
	}
	
	public function getPagesByMenu($menu, $addDepth=false)
	{
		$menu = (string) $menu;
		$result = $this->getMapper()->getPagesByMenu($menu);
		
		if ($addDepth) {
            $result->getHydrator()->addDepth();
        }
        
        return $result;
	}
	
	public function addPage($post)
	{
		$page = $this->getMapper()->getModel();
		$form  = $this->getForm($page, $post, true, true);
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
	
	public function editPage(PageModel $page, $post)
	{
		$form  = $this->getForm($page, $post, true, true);
	
		if (!$form->isValid()) {
			return $form;
		}
		
		$page = $this->getById($page->getPageId());
	
		if ($page) {
			// if page postion has changed then we need to delete it
			// and reinsert it in the new position else just update it.
			if ($post['position']) {
				// TODO find children and move them as well.
				$del = $this->delete($page->getPageId());
	
				if ($del) {
					$result = $this->addPage($post);
				}
			} else {
				$data = $this->getMapper()->extract($form->getData());
				
				$pk = $this->getMapper()->getPrimaryKey();
				$id = $data[$pk];
				unset($data[$pk]);
				
				$result = $this->getMapper()->update($data, [$pk => $id]);
			}
		} else {
			throw new Exception('Page id does not exist');
		}
	
		return $result;
	}
}
