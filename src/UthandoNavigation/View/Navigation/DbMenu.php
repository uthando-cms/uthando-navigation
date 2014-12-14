<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\View\Navigation
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\View\Navigation;

use Zend\View\Helper\Navigation\Menu;

/**
 * Class DbMenu
 * @package UthandoNavigation\View\Navigation
 */
class DbMenu extends Menu
{   
	use DbMenuTrait;
}
