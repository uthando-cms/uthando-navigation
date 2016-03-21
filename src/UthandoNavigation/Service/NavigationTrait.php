<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNavigation\Service;

use Zend\Mvc\Application;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\RouteStackInterface;

/**
 * Class NavigationTrait
 *
 * @package UthandoNavigation\Service
 */
trait NavigationTrait
{
    /**
    * @param $pages
    * @return array
    */
    public function preparePages($pages)
    {
        /* @var  Application $application */
        $application = $this->getService('Application');
        $routeMatch  = $application->getMvcEvent()->getRouteMatch();
        $router      = $application->getMvcEvent()->getRouter();

        return $this->injectComponents($pages, $routeMatch, $router);
    }

    /**
     * @param array $pages
     * @param RouteMatch|null $routeMatch
     * @param RouteStackInterface|null $router
     * @return array
     */
    protected function injectComponents(array $pages, RouteMatch $routeMatch = null, RouteStackInterface $router = null)
    {
        foreach ($pages as &$page) {

            $hasMvc = isset($page['action']) || isset($page['controller']) || isset($page['route']);
            if ($hasMvc) {
                if (!isset($page['routeMatch']) && $routeMatch) {
                    $page['routeMatch'] = $routeMatch;
                }

                if (!isset($page['router'])) {
                    $page['router'] = $router;
                }
            }

            if (isset($page['pages'])) {
                $page['pages'] = $this->injectComponents($page['pages'], $routeMatch, $router);
            }
        }

        return $pages;
    }
}
