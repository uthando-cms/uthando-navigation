<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Event
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Event;

use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

/**
 * Class ServiceListener
 * @package UthandoNavigation\Event
 */
class ServiceListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    public function attach(EventManagerInterface $events)
    {
        $events = $events->getSharedManager();

        $this->listeners[] = $events->attach([
            'UthandoNavigation\Service\MenuItem'
        ], ['form.init'], [$this, 'menuItemForm']);
    }

    public function menuItemForm(Event $e)
    {
        $data  = $e->getParam('data');
        $model = $e->getParam('model');
        $form = $e->getParam('form');

        if (isset($data['menuId'])) {
            $menuId = $data['menuId'];
        } elseif ($model) {
            $menuId = $model->getMenuId();
        } elseif ($form) {
            $menuId = $form->get('menuId')->getValue();
        }

        if (isset($menuId)) {
            $form->get('position')->setMenuId($menuId);
        }
    }
}
