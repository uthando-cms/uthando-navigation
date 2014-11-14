<?php

namespace UthandoNavigation\View\Navigation;

use Zend\Config\Reader\Ini;
use Zend\Navigation\Navigation;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\RouteStackInterface as Router;

trait DbMenuTrait
{
    public function __invoke($container = null)
    {
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

            $pageArray[] = $p;
        }

        return new Navigation($this->preparePages($this->listToMultiArray($pageArray)));
    }

    /*public function traverseArray(&$array, $keys)
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                self::traverseArray($value, $keys);
            } else {
                if (in_array($key, $keys) || '' == $value){
                    unset($array[$key]);
                }
            }
        }
        return $array;
    }*/

    public function listToMultiArray($arrs)
    {
        $nested = [];
        $depths = [];

        foreach($arrs as $key => $arr) {

            if( $arr['depth'] == 0 ) {
                $nested[$key] = $arr;
            } else {
                $parent =& $nested;

                for ($i = 1; $i <= ($arr['depth']); $i++) {
                    $parent =& $parent[$depths[$i]];
                }

                $parent['pages'][$key] = $arr;
            }

            $depths[$arr['depth'] + 1] = $key;
        }

        return $nested;
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
} 