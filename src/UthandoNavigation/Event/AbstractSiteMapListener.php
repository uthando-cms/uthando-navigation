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
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Navigation\Navigation;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Class SiteMapListenerTrait
 *
 * @package UthandoNavigation\Event
 */
abstract class AbstractSiteMapListener implements SiteMapListenerInterface, ServiceLocatorAwareInterface
{
    /**
     * @var array
     */
    protected $pages = [];

    /**
     * @var Event
     */
    protected $event;

    use ListenerAggregateTrait,
        ServiceLocatorAwareTrait;

    /**
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        $events = $events->getSharedManager();

        $this->listeners[] = $events->attach([
            'UthandoNavigation\Service\SiteMap',
        ], ['uthando.site-map'], [$this, 'addPages']);
    }

    /**
     * @param Event $e
     */
    public function addPages(Event $e)
    {
        $this->event = $e;
        $pages = $this->getPages();

        // find parent page
        $parentPage = $this->getNavigation()
            ->findOneByRoute($this->getRoute());

        // add pages to parent
        $parentPage->addPages($e->getTarget()->preparePages($pages));
    }

    /**
     * @return array
     */
    abstract function getPages() : array;

    /**
     * @return string
     */
    abstract function getRoute() : string;

    /**
     * @return Navigation
     */
    public function getNavigation() : Navigation
    {
        return $this->event->getParam('navigation');
    }
}
