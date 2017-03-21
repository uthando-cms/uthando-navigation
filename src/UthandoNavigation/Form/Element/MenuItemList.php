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

    /**
     * @var string
     */
    protected $emptyOption = '---Please Select a page---';
    
    /**
     * @var int
     */
    protected $menuId = 0;

    /**
     * @param array|\Traversable $options
     * @return void|Select|\Zend\Form\ElementInterface
     */
    public function setOptions($options)
    {
        parent::setOptions($options);
        
        if (isset($this->options['menu_id'])) {
            $this->setMenuId($this->options['menu_id']);
        }
    }

    /**
     * @return array
     */
    public function getValueOptions()
    {
    	return ($this->valueOptions) ?: $this->getMenuItems();
    }

    /**
     * @return array
     */
    public function getMenuItems()
    {
        $serviceManager = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('UthandoServiceManager');

        /* @var $menuItemMapper \UthandoNavigation\Service\MenuItem */
        $menuItemMapper = $serviceManager->get('UthandoNavigationMenuItem');

        /* @var $menuMapper \UthandoNavigation\Service\Menu */
        $menuMapper = $serviceManager->get('UthandoNavigationMenu');

        $menuItemsOptions   = [];
        $menuArray          = [];

        if ($this->getMenuId()) {
            $items = $menuItemMapper->getMenuItemsByMenuId($this->getMenuId());
            $menus = [$menuMapper->getById($this->getMenuId())];
        } else {
            $menus = $menuMapper->fetchAll();
            $items = $menuItemMapper->fetchAll();
        }

        foreach ($menus as $menu) {
            $menuArray[$menu->getMenuId()] = $menu->getMenu();
            $menuItemsOptions[$menu->getMenuId()]['options'][$menu->getMenuId() . '-' . '0'] = 'At top of this menu';
            $menuItemsOptions[$menu->getMenuId()]['label'] = $menu->getMenu();
        }

        /* @var $page \UthandoNavigation\Model\MenuItem */
        foreach ($items as $menuItem) {
            $ident = ($menuItem->getDepth() > 0) ? str_repeat('&nbsp;&nbsp;',($menuItem->getDepth())) . '&bull;&nbsp;' : '';
            $menuItemsOptions[$menuItem->getMenuId()]['options'][] = [
                'value'                 => $menuItem->getMenuId() . '-' . $menuItem->getMenuItemId(),
                'label'                 => $ident . $menuItem->getLabel(),
                'disable_html_escape'   => true,
            ];
        }
        
        return $menuItemsOptions;
    }

    /**
     * @return int
     */
    public function getMenuId()
    {
    	return $this->menuId;
    }

    /**
     * @param $menuId
     * @return $this
     */
    public function setMenuId($menuId)
    {
    	$this->menuId = $menuId;
    	return $this;
    }
}
