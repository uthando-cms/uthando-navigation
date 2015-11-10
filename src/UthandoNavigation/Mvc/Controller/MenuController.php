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
 * Class MenuController
 *
 * @package UthandoNavigation\Mvc\Controller
 */
class MenuController extends AbstractCrudController
{
	protected $controllerSearchOverrides = array('sort' => 'menu');
	protected $serviceName = 'UthandoNavigationMenu';
	protected $route = 'admin/menu';
	
}
