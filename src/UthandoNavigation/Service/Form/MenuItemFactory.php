<?php
namespace UthandoNavigation\Service\Form;

use UthandoNavigation\Form\MenuItem;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MenuItemFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $sm)
	{
		$config = $sm->get('config');
		$mapper = $sm->get('UthandoNavigation\Mapper\MenuItem');
		
		$form = new MenuItem();
		$form->setConfig($config);
		$form->setMenuItemMapper($mapper);
		$form->init();
		
		return $form;
	}
}
