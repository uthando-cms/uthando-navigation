<?php
namespace UthandoNavigation\InputFilter;

use Zend\InputFilter\InputFilter;

class MenuItem extends InputFilter
{
	public function __construct()
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
