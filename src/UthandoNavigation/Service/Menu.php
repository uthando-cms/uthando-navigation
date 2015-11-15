<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNavigation\Service;

use UthandoCommon\Service\AbstractMapperService;
use UthandoCommon\Stdlib\ArrayUtils;
use UthandoNavigation\Mapper\Menu as MenuMapper;
use UthandoNavigation\Model\Menu as MenuModel;
use Zend\Config\Reader\Ini;
use Zend\Mvc\Application;
use Zend\Navigation\Navigation;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\RouteStackInterface as Router;

/**
 * Class Menu
 * @package UthandoNavigation\Service
 * @method MenuMapper getMapper($mapperClass = null, array $options = [])
 */
class Menu extends AbstractMapperService
{
    /**
     * @var string
     */
    protected $serviceAlias = 'UthandoNavigationMenu';

    /**
     * @var bool
     */
    protected $multiArray;

    /**
     * @param $menuName
     * @return MenuModel
     */
    public function getMenu($menuName)
    {
        $menuName = (string) $menuName;
        return $this->getMapper()->getMenu($menuName);
    }

    /**
     * @param null $menu
     * @param bool|true $multiArray
     * @return Navigation
     */
    public function getPages($menu = null, $multiArray = true)
    {
        /* @var $service \UthandoNavigation\Service\MenuItem */
        $service = $this->getService('UthandoNavigationMenuItem');

        $config = new Ini();

        if (null === $menu) {
            $pages = $service->fetchAll();
        } else {
            $pages = $service->getMenuItemsByMenu($menu);
        }

        $pageArray = [];

        /* @var $page \UthandoNavigation\Model\MenuItem */
        foreach ($pages as $page) {
            $p = $page->getArrayCopy();
            $params = $config->fromString($p['params']);

            // need to initialise params array else error occurs
            $p['params'] = [];

            // params contain route params and other element params like:
            // id, class etc.
            foreach ($params as $key => $value) {
                $p[$key] = $value;
            }

            if ($p['route'] == '0') {
                unset($p['route']);
                $p['uri'] = '#';
            } else {
                unset($p['uri']);
            }

            if ($p['resource'] == null) {
                unset($p['resource']);
            }

            $pageArray[] = $p;
        }

        if ($multiArray) {
            $pageArray = ArrayUtils::listToMultiArray($pageArray);
        }

        return new Navigation($this->preparePages($pageArray));
    }

    /**
     * @param $pages
     * @return array
     */
    protected function preparePages($pages)
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
     * @param Router|null $router
     * @return array
     */
    protected function injectComponents(array $pages, RouteMatch $routeMatch = null, Router $router = null)
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
