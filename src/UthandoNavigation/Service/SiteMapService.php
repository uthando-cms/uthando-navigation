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

use UthandoCommon\Cache\CacheStorageAwareInterface;
use UthandoCommon\Cache\CacheTrait;
use UthandoCommon\Service\AbstractService;
use UthandoNavigation\View\Navigation;

/**
 * Class SiteMap
 *
 * @package UthandoNavigation\Service
 */
class SiteMapService extends AbstractService implements CacheStorageAwareInterface
{
    use CacheTrait,
        NavigationTrait;

    /**
     * Returns a formatted xml sitemap string
     *
     * @return string
     */
    public function getSiteMap()
    {
        $sitemap = $this->getCacheItem('site-map');

        if (null === $sitemap) {
            /* @var $menuService MenuService */
            $menuService = $this->getService(MenuService::class);

            $navigation = $menuService->getPages();

            $argv = $this->prepareEventArguments(compact('navigation'));
            $this->getEventManager()->trigger('uthando.site-map', $this, $argv);

            $sitemap = $this->getService('ViewHelperManager')
                ->get(Navigation::class)
                ->setRole('guest')
                ->sitemap($navigation)
                ->render();

            $this->setCacheItem('site-map', $sitemap);
        }

        return $sitemap;
    }
}
