<?php
namespace UthandoNavigation\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class MenuItemList extends Select implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    
    protected $emptyOption = '---Please select a menu item---';
    
    /**
     * @var int
     */
    protected $menuId = 0;
    
    public function setOptions($options)
    {
        parent::setOptions($options);
        
        if (isset($this->options['menu_id'])) {
            $this->setMenuId($this->options['menu_id']);
        }
    }
    
    public function getValueOptions()
    {
    	return ($this->valueOptions) ?: $this->getMenuItems();
    }
    
    public function getMenuItems()
    {
        $items = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('UthandoNavigation\Mapper\MenuItem')
            ->getMenuItemsByMenuId($this->getMenuId());
        
        $menuItemOptions = [];
         
        $menuItemOptions[0] = 'Add to top of menu';
         
        foreach($items as $item){
        	$menuItemOptions[$item->getMenuItemId()] = $item->getLabel();
        }
        
        return $menuItemOptions;
    }
    
    public function getMenuId()
    {
    	return $this->menuId;
    }
    
    public function setMenuId($menuId)
    {
    	$this->menuId = $menuId;
    	return $this;
    }
}
