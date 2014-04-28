<?php

namespace UthandoNavigation\Controller;

use UthandoCommon\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;

class MenuController extends AbstractCrudController
{
	protected $searchDefaultParams = array('sort' => 'menu');
	protected $serviceName = 'UthandoNavigation\Service\Menu';
	protected $route = 'admin/menu';
	
    public function listAction()
    {	
        return new ViewModel(array(
        	'menus' => $this->getService()->fetchAll()
        ));
    }
}
