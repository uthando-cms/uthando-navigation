<?php
namespace UthandoNavigation\Service;

use Zend\Navigation\Service\AbstractNavigationFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class DbNavigationFactory extends AbstractNavigationFactory
{   
	protected function getName()
	{
		return 'default';
	}
	
	protected function getPages(ServiceLocatorInterface $serviceLocator)
	{
		/* @var $servie \Navigation\Service\MenuItem */
		$service = $serviceLocator->get('UthandoNavigation\Service\MenuItem');
	
		$pages = $service->getAllMenusAndMenuItems();
	
		$pageArray = [];
	
		/* @var $page \Navigation\Model\MenuItem */
		foreach ($pages as $page) {
			$p = $pages->getHydrator()->extract($page);
			$p['params'] = parse_ini_string($p['params']);
	
			if ($p['route'] == '0') {
				unset($p['route']);
			} else {
				unset($p['uri']);
			}
	
			$pageArray[] = $p;
		}
	
		return new $this->listToMultiArray($pageArray);
	}
	
	protected function listToMultiArray($arrs)
	{
		$nested = [];
		$depths = [];
	
		foreach($arrs as $key => $arr) {
	
			if( $arr['depth'] == 0 ) {
				$nested[$key] = $arr;
			} else {
				$parent =& $nested;
	
				for ($i = 1; $i <= ($arr['depth']); $i++) {
					$parent =& $parent[$depths[$i]];
				}
	
				$parent['pages'][$key] = $arr;
			}
	
			$depths[$arr['depth'] + 1] = $key;
		}
	
		return $nested;
	}
	
    public function traverseArray(&$array, $keys)
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                self::traverseArray($value, $keys);
            } else {
                if (in_array($key, $keys) || '' == $value){
                    unset($array[$key]);
                }
            }
        }
        
        return $array;
    }
	
}