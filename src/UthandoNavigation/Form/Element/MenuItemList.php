<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Form\Element
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Class MenuItemList
 * @package UthandoNavigation\Form\Element
 */
class MenuItemList extends Select implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    
    //protected $emptyOption = '---Please select a menu item---';
    
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
        /* @var $service \UthandoNavigation\Service\MenuItem */
        $service = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('UthandoServiceManager')
            ->get('UthandoNavigationMenuItem');
        $items = $service->getMenuItemsByMenuId($this->getMenuId());
        
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
