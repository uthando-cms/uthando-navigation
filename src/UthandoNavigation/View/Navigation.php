<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\View
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\View;

use Zend\View\Helper\Navigation as ZendNavigation;

/**
 * Class Navigation
 *
 * @package UthandoNavigation\View
 */
class Navigation extends ZendNavigation
{
    /**
     * Default set of helpers to inject into the plugin manager
     *
     * @var array
     */
    protected $defaultPluginManagerHelpers = [
        'uthandoDbMenu'     => 'UthandoNavigation\View\Navigation\DbMenu',
        'uthandoTbDbMenu'   => 'UthandoNavigation\View\Navigation\TwitterBootstrapDbMenu',
        'uthandoTbMenu'     => 'UthandoNavigation\View\Navigation\TwitterBootstrapMenu',
    ];

    /**
     * Retrieve plugin loader for navigation helpers
     *
     * Lazy-loads an instance of Navigation\HelperLoader if none currently
     * registered.
     *
     * @return \Zend\View\Helper\Navigation\PluginManager
     */
    public function getPluginManager()
    {
        $pm = parent::getPluginManager();
        
        foreach ($this->defaultPluginManagerHelpers as $name => $invokableClass) {
            $pm->setInvokableClass($name, $invokableClass);
        }
        
        return $pm;
    }
}
