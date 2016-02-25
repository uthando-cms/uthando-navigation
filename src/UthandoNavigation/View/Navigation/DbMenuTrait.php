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

/**
 * Class DbMenuTrait
 *
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
            ->get('UthandoServiceManager')
            ->get('UthandoNavigationMenu');

        $container = $service->getPages($container, $useMultiArray);

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