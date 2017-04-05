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

use UthandoCommon\Filter\Ucwords;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Uri\Http;
use Zend\Validator\StringLength;
use Zend\Validator\Uri;

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
                ['name'    => StripTags::class],
                ['name'    => StringTrim::class],
                ['name'    => Ucwords::class],
            ],
            'validators' => [
                ['name'    => StringLength::class, 'options' => [
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
                ['name'    => StripTags::class],
                ['name'    => StringTrim::class],
            ],
        ]);
		
		$this->add([
            'name'       => 'route',
            'required'   => false,
            'filters'    => [
                ['name'    => StripTags::class],
                ['name'    => StringTrim::class],
            ],
            'validators' => [
                ['name'    => StringLength::class, 'options' => [
                    'encoding' => 'UTF-8',
                    'min'      => 0,
                    'max'      => 255,
                ]],
            ],
        ]);

        $this->add([
            'name'       => 'uri',
            'required'   => false,
            'filters'    => [
                ['name'    => StripTags::class],
                ['name'    => StringTrim::class],
            ],
            'validators' => [
                ['name'    => StringLength::class, 'options' => [
                    'encoding' => 'UTF-8',
                    'min'      => 0,
                    'max'      => 255,
                ]],
                ['name' => Uri::class, 'options' => [
                    'uriHandler'    => Http::class,
                    'allowRelative' => false,
                ]],
            ],
        ]);
		
		$this->add([
            'name'       => 'resource',
            'required'   => false,
            'filters'    => [
                ['name'    => StripTags::class],
                ['name'    => StringTrim::class],
            ],
            'validators' => [
                ['name'    => StringLength::class,'options' => [
                    'encoding' => 'UTF-8',
                    'min'      => 2,
                    'max'      => 255,
                ]],
            ],
        ]);
	}
}
