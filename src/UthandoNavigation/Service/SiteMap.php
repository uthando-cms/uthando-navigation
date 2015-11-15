<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNavigation\Service;

use UthandoCommon\Service\AbstractService;

/**
 * Class SiteMap
 *
 * @package UthandoNavigation\Service
 */
class SiteMap extends AbstractService
{
    /**
     * @var string
     */
    protected $serviceAlias = 'UthandoNavigationSiteMap';

    /**
     * @return \Zend\Navigation\Navigation
     */
    public function getSiteMap()
    {
        /* @var $menuService Menu */
        $menuService = $this->getService('UthandoNavigationMenu');

        $siteMap = $menuService->getPages();

        $argv = $this->prepareEventArguments(compact('siteMap'));
        $this->getEventManager()->trigger('uthando.site-map', $this, $argv);
        //$siteMap = $argv['$siteMap'];

        return $siteMap;
    }
}
