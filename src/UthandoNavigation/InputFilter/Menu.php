<?php
namespace UthandoNavigation\InputFilter;

use Zend\InputFilter\InputFilter;

class Menu extends InputFilter
{
	public function __construct()
	{
		$this->add([
            'name'       => 'menu',
            'required'   => true,
            'filters'    => [
                ['name'    => 'StripTags'],
                ['name'    => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 255,
                    ],
                ],
            ],
		]);
	}
}
