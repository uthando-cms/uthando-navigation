<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNavigation\Service;

use UthandoCommon\Service\AbstractMapperService;
use UthandoCommon\Stdlib\ArrayUtils;
use UthandoNavigation\Form\MenuForm;
use UthandoNavigation\Hydrator\MenuHydrator;
use UthandoNavigation\InputFilter\MenuInputFilter;
use UthandoNavigation\Mapper\MenuMapper;
use UthandoNavigation\Model\MenuItemModel;
use UthandoNavigation\Model\MenuModel;
use Zend\Config\Reader\Ini;
use Zend\Navigation\Navigation;

/**
 * Class Menu
 * @package UthandoNavigation\Service
 * @method MenuMapper getMapper($mapperClass = null, array $options = [])
 */
class MenuService extends AbstractMapperService
{
    use NavigationTrait;

    protected $form         = MenuForm::class;
    protected $hydrator     = MenuHydrator::class;
    protected $inputFilter  = MenuInputFilter::class;
    protected $mapper       = MenuMapper::class;
    protected $model        = MenuModel::class;

    /**
     * @var bool
     */
    protected $multiArray;

    /**
     * @param $menuName
     * @return MenuModel
     */
    public function getMenu($menuName)
    {
        $menuName = (string) $menuName;
        return $this->getMapper()->getMenu($menuName);
    }

    /**
     * @param null $menu
     * @param bool|true $multiArray
     * @return Navigation
     */
    public function getPages($menu = null, $multiArray = true)
    {
        /* @var $service MenuItemService */
        $service = $this->getService(MenuItemService::class);

        $config = new Ini();

        if (null === $menu) {
            $pages = $service->fetchAll();
        } else {
            $pages = $service->getMenuItemsByMenu($menu);
        }

        $pageArray = [];

        /* @var $page MenuItemModel */
        foreach ($pages as $page) {
            $p = $page->getArrayCopy();
            $params = $config->fromString($p['params']);

            // need to initialise params array else error occurs
            $p['params'] = [];

            // params contain route params and other element params like:
            // id, class etc.
            foreach ($params as $key => $value) {
                $p[$key] = $value;
            }

            switch ($p['route']) {
                case 'heading':
                    $p['uri'] ='#';
                    unset($p['route']);
                    break;
                case 'link':
                    unset($p['route']);
                    break;
                default:
                    unset($p['uri']);
                    break;
            }

            if ($p['resource'] == null) {
                unset($p['resource']);
            }

            $pageArray[] = $p;
        }

        if ($multiArray) {
            $pageArray = ArrayUtils::listToMultiArray($pageArray);
        }

        return new Navigation($this->preparePages($pageArray));
    }
}
