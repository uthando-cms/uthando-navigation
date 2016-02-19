<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\View\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2016 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNavigation\View\Service;

use UthandoNavigation\View\Navigation;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\Identity;
use Zend\View\HelperPluginManager;

/**
 * Class NavigationFactory
 *
 * @package UthandoNavigation\View\Service
 */
class NavigationFactory implements FactoryInterface
{
    /**
     * @var Identity
     */
    protected $identityHelper;

    /**
     * @var HelperPluginManager
     */
    protected $serviceLocator;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        $acl = $this->serviceLocator->getServiceLocator()
            ->get('UthandoUser\Service\Acl');

        $identity = $this->getIdentityHelper();

        $role = ($identity()) ? $identity()->getRole() : 'guest';

        $service = new Navigation();
        $service->setAcl($acl);
        $service->setRole($role);

        $service->setServiceLocator($this->serviceLocator->getServiceLocator());

        return $service;
    }

    /**
     * @return Identity
     */
    protected function getIdentityHelper()
    {
        if (!$this->identityHelper instanceof Identity) {
            $identity = $this->serviceLocator->get('identity');
            $this->identityHelper = $identity;
        }

        return $this->identityHelper;

    }
}
