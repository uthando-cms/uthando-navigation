<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Mvc\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNavigation\Controller;

use UthandoCommon\Service\ServiceTrait;
use UthandoNavigation\Service\SiteMapService;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class SiteMapController
 *
 * @package UthandoNavigation\Controller
 * @method SiteMapService getService()
 */
class SiteMapController extends AbstractActionController
{
    use ServiceTrait;

    /**
     * SiteMapController constructor.
     */
    public function __construct()
    {
        $this->serviceName = SiteMapService::class;
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
