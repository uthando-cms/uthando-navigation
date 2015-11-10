<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Mvc\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNavigation\Mvc\Controller;

use UthandoCommon\Controller\AbstractCrudController;

/**
 * Class MenuItemController
 *
 * @package UthandoNavigation\Mvc\Controller
 */
class MenuItemController extends AbstractCrudController
{
	protected $controllerSearchOverrides = ['sort' => 'lft'];
	protected $serviceName = 'UthandoNavigationMenuItem';
	protected $route = 'admin/menu-item';
	
	protected function setMenuId()
	{
	    $menuId = $this->params('menuId', 0);
	    $this->searchDefaultParams['menuId'] = $menuId;
	    
	    $session = $this->sessionContainer($this->getServiceName());
	    
	    $params = ($session->offsetGet('params')) ?: [];
	    
	    $params['menuId'] = $menuId;
	    
	    $session->offsetSet('params', $params);
	    
	    return $menuId;
	}
	
    public function indexAction()
    {  	
    	$menuId = $this->setMenuId();
    	
    	if (!$menuId) return $this->redirect()->toRoute('admin/menu');
    	
        $viewModel = parent::indexAction();
        
        $viewModel->setVariable('menuId', $menuId);
        
        return $viewModel;
    }
    
    public function listAction()
    {
        $menuId = $this->setMenuId();
        
        $viewModel = parent::listAction();
        
        $viewModel->setVariable('menuId', $menuId);
        
        return $viewModel;
    }
}
