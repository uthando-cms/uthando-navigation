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
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine(
            'Content-Type', 'text/xml'
        );

        $sitemap = $this->getService()->getSiteMap();

        $response->setStatusCode(200);
        $response->setContent($sitemap);

        return $response;
    }
}
