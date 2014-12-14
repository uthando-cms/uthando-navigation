<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Controller;

use UthandoCommon\Controller\AbstractCrudController;

/**
 * Class MenuItemController
 * @package UthandoNavigation\Controller
 */
class MenuItemController extends AbstractCrudController
{
	protected $searchDefaultParams = ['sort' => 'lft'];
	protected $serviceName = 'UthandoNavigation\Service\MenuItem';
	protected $route = 'admin/menu-item';
	
    public function indexAction()
    {    	
    	$menuId = $this->params('menuId', 0);
    	$this->searchDefaultParams['menuId'] = $menuId;
    	
    	if (!$menuId) return $this->redirect()->toRoute('admin/menu');
    	
        $viewModel = parent::indexAction();
        
        $viewModel->setVariable('menuId', $menuId);
        
        return $viewModel;
    }
    
    public function listAction()
    {
        $menuId = $this->params('menuId', 0);
        $this->searchDefaultParams['menuId'] = $menuId;
        
        $viewModel = parent::listAction();
        
        $viewModel->setVariable('menuId', $menuId);
        
        return $viewModel;
    }
}
