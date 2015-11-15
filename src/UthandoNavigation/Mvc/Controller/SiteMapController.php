<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Mvc\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNavigation\Mvc\Controller;

use UthandoCommon\Service\ServiceTrait;
use UthandoNavigation\Service\SiteMap;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class SiteMapController
 *
 * @package UthandoNavigation\Mvc\Controller
 * @method SiteMap getService()
 */
class SiteMapController extends AbstractActionController
{
    use ServiceTrait;

    /**
     * SiteMapController constructor.
     */
    public function __construct()
    {
        $this->serviceName = 'UthandoNavigationSiteMap';
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $this->getResponse()->getHeaders()->addHeaderLine(
            'Content-Type', 'text/xml'
        );

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);

        return $viewModel->setVariable('siteMap', $this->getService()->getSiteMap());
    }
}
