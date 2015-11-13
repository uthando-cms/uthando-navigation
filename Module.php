<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation;

use UthandoCommon\Config\ConfigInterface;
use UthandoCommon\Config\ConfigTrait;
use UthandoNavigation\Event\ServiceListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 *
 * @package UthandoNavigation
 */
class Module implements ConfigInterface
{
    use ConfigTrait;

    /**
     * @param MvcEvent $e
     */
    public function onBootStrap(MvcEvent $e)
    {
        $app = $e->getApplication();
        $eventManager = $app->getEventManager();

        $eventManager->attachAggregate(new ServiceListener());
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php'
            ],
        ];
    }
}
