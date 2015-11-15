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

        /* @var $service \UthandoNavigation\Service\Menu */
        $service = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('UthandoServiceManager')
            ->get('UthandoNavigationMenu');

        $container = $service->getPages($container, $useMultiArray);

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

    /**
     * @return boolean
     */
    public function isMultiArray()
    {
        return $this->multiArray;
    }
} 