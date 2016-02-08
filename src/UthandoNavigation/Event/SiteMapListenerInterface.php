<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Event
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNavigation\Event;

use Zend\EventManager\Event;
use Zend\Navigation\Navigation;

/**
 * Interface SiteMapListenerInterface
 *
 * @package UthandoNavigation\Event
 */
interface SiteMapListenerInterface
{
    /**
     * @param Event $e
     * @return void
     */
    public function addPages(Event $e);

    /**
     * @return array
     */
    public function getPages() : array;

    /**
     * @return string
     */
    public function getRoute() : string;

    /**
     * @return Navigation
     */
    public function getNavigation() : Navigation;
}
