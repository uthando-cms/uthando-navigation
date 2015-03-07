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
 * Class MenuController
 * @package UthandoNavigation\Controller
 */
class MenuController extends AbstractCrudController
{
	protected $controllerSearchOverrides = array('sort' => 'menu');
	protected $serviceName = 'UthandoNavigationMenu';
	protected $route = 'admin/menu';
	
}
