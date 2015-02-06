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

use UthandoCommon\Stdlib\ArrayUtils;
use Zend\Config\Reader\Ini;
use Zend\Navigation\Navigation;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\RouteStackInterface as Router;

/**
 * Class DbMenuTrait
 * @package UthandoNavigation\View\Navigation
 */
trait DbMenuTrait
{
    /**
     * @var bool
     */
    protected $multiArray;

    public function __invoke($container = null, $useMultiArray = true)
    {
        $this->multiArray = $useMultiArray;

        $container = $this->getPages($container);

        // hack as acl and roles get reset to null
        // on every menu request.
        if (!$this->hasAcl()) {
            $acl = $this->getServiceLocator()
                ->getServiceLocator()
                ->get('UthandoUser\Service\Acl');
            $this->setAcl($acl);
        }

        if (!$this->hasRole()) {
            $identity = $this->view->plugin('identity');
            $role = ($identity()) ? $identity()->getRole() : 'guest';
            $this->setRole($role);
        }

        return parent::__invoke($container);
    }

    protected function getPages($menu)
    {
        /* @var $service \UthandoNavigation\Service\MenuItem */
        $service = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('UthandoNavigation\Service\MenuItem');

        $config = new Ini();

        $pages = $service->getMenuItemsByMenu($menu, true);

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

        if ($this->isMultiArray()) {
            $pageArray = ArrayUtils::listToMultiArray($pageArray);
        }

        return new Navigation($this->preparePages($pageArray));
    }

    protected function preparePages($pages)
    {
        $application = $this->getServiceLocator()->getServiceLocator()->get('Application');
        $routeMatch  = $application->getMvcEvent()->getRouteMatch();
        $router      = $application->getMvcEvent()->getRouter();

        return $this->injectComponents($pages, $routeMatch, $router);
    }

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

    /**
     * @return boolean
     */
    public function isMultiArray()
    {
        return $this->multiArray;
    }
} 