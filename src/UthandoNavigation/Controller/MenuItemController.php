<?php

namespace UthandoNavigation\Controller;

use UthandoCommon\Controller\AbstractCrudController;

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
