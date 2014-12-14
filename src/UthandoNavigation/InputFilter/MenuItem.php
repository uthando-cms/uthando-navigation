<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\InputFilter
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */
namespace UthandoNavigation\InputFilter;

use Zend\InputFilter\InputFilter;

/**
 * Class MenuItem
 * @package UthandoNavigation\InputFilter
 */
class MenuItem extends InputFilter
{
	public function init()
	{
		$this->add([
            'name'       => 'label',
            'required'   => true,
            'filters'    => [
                ['name'    => 'StripTags'],
                ['name'    => 'StringTrim'],
                ['name'    => 'UthandoCommon\Filter\Ucwords'],
            ],
            'validators' => [
                ['name'    => 'StringLength', 'options' => [
                    'encoding' => 'UTF-8',
                    'min'      => 2,
                    'max'      => 255,
                ]],
            ],
        ]);
		
		$this->add([
            'name'       => 'params',
            'required'   => false,
            'filters'    => [
                ['name'    => 'StripTags'],
                ['name'    => 'StringTrim'],
            ],
        ]);
		
		$this->add([
            'name'       => 'route',
            'required'   => false,
            'filters'    => [
                ['name'    => 'StripTags'],
                ['name'    => 'StringTrim'],
            ],
            'validators' => [
                ['name'    => 'StringLength', 'options' => [
                    'encoding' => 'UTF-8',
                    'min'      => 0,
                    'max'      => 255,
                ]],
            ],
        ]);
		
		$this->add([
            'name'       => 'resource',
            'required'   => false,
            'filters'    => [
                ['name'    => 'StripTags'],
                ['name'    => 'StringTrim'],
            ],
            'validators' => [
                ['name'    => 'StringLength','options' => [
                    'encoding' => 'UTF-8',
                    'min'      => 2,
                    'max'      => 255,
                ]],
            ],
        ]);
	}
}
