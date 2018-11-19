<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Service;

use UthandoCommon\Service\ServiceManager;
use UthandoCommon\Stdlib\ArrayUtils;
use UthandoNavigation\Model\MenuItemModel;
use Zend\Config\Reader\Ini;
use Zend\Navigation\Navigation;
use Zend\Navigation\Service\AbstractNavigationFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DbNavigationFactory
 * @package UthandoNavigation\Service
 */
class DbNavigationFactory extends AbstractNavigationFactory
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    protected function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    protected function getPages(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $service MenuItemService */
        $service = $serviceLocator->get(ServiceManager::class)
            ->getService(MenuItemService::class);

        $config = new Ini();

        if (null === $this->getName()) {
            $pages = $service->fetchAll();
        } else {
            $pages = $service->getMenuItemsByMenu($this->getName());
        }

        $pageArray = [];

        /* @var $page MenuItemModel */
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

        $pageArray = ArrayUtils::listToMultiArray($pageArray);

        return new Navigation($this->preparePages($pageArray));
    }
}
