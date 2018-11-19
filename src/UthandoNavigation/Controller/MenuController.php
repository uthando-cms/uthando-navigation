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

namespace UthandoNavigation\Controller;

use UthandoCommon\Controller\AbstractCrudController;
use UthandoNavigation\Service\MenuService;

/**
 * Class MenuController
 *
 * @package UthandoNavigation\Mvc\Controller
 */
class MenuController extends AbstractCrudController
{
	protected $controllerSearchOverrides = array('sort' => 'menu');
	protected $serviceName = MenuService::class;
	protected $route = 'admin/menu';
	
}
