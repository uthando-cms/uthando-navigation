<?php

namespace UthandoNavigation\View;

use UthandoCommon\View\AbstractViewHelper;
use Zend\Form\Element;

class NavigationForm extends AbstractViewHelper
{
	public function __invoke()
    {
    	/* @var $menuItemMapper \UthandoNavigation\Service\MenuItem */
        $menuItemMapper = $this->getServiceLocator()->getServiceLocator()->get('UthandoNavigation\Service\MenuItem');
        $menuItems = $menuItemMapper->fetchAll();
        
        /* @var $menuMapper \UthandoNavigation\Service\Menu */
        $menuMapper = $this->getServiceLocator()->getServiceLocator()->get('UthandoNavigation\Service\Menu');
        $menus = $menuMapper->fetchAll();
        
        $select = new Element\Select('position');
        $menuItemsOptions = [];
        $menuArray = [];
        
        foreach ($menus as $menu) {
            $menuArray[$menu->getMenuId()] = $menu->getMenu();
            
            $menuItemsOptions[$menu->getMenuId()]['options'][$menu->getMenuId() . '-' . '0'] = 'At top of this menu';
            $menuItemsOptions[$menu->getMenuId()]['empty_option'] = '---Please Select a page---';
            $menuItemsOptions[$menu->getMenuId()]['label'] = $menu->getMenu();
            
        }
        
        /* @var $page \UthandoNavigation\Model\MenuItem */
        foreach ($menuItems as $menuItem) {
            
            $ident = ($menuItem->getDepth() > 0) ? str_repeat('%space%%space%',($menuItem->getDepth())) . '%bull%%space%' : '';
            
            $menuItemsOptions[$menuItem->getMenuId()]['options'][$menuItem->getMenuId() . '-' . $menuItem->getMenuItemId()] = $ident . $menuItem->getLabel();
        }
        
        $select = new Element\Select('position');
        $select->setLabel('Location In Menu:');
        $select->setValueOptions($menuItemsOptions);
        $select->setEmptyOption('Please select a Position');
        
        $element = $this->view->plugin('formElement');
        $errors = $this->view->plugin('formElementErrors');
        
        $html = $element($select);
        
        $html = str_replace('%space%', '&nbsp;', $html);
        $html = str_replace('%bull%', '&bull;', $html);
        
        $html = '<div class="control-group">
                     <label class="control-label" for="position">'.$select->getLabel().'</label>
                     <div class="controls">' .
                         $html . '
                         <span class="help-block">' .
                             $errors($select, [
                                "class" => "unstyled"
                            ]) . '
                         </span>
                     </div>
                 </div>';
        
        return $html;
    }
}
