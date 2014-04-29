<?php

namespace UthandoNavigation\Controller;

use UthandoCommon\Controller\AbstractCrudController;

class MenuController extends AbstractCrudController
{
	protected $searchDefaultParams = array('sort' => 'menu');
	protected $serviceName = 'UthandoNavigation\Service\Menu';
	protected $route = 'admin/menu';
	
}
