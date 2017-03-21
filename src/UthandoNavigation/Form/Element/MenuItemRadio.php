<?php
/**
 * Created by PhpStorm.
 * User: shaun
 * Date: 19/03/2017
 * Time: 21:45
 */

namespace UthandoNavigation\Form\Element;

use UthandoCommon\Mapper\AbstractNestedSet;
use Zend\Form\Element\Radio;

class MenuItemRadio extends Radio
{
    public function init()
    {
        $valueOptions = [
            [
                'value' => 'noInsert',
                'label' => 'No change.',
                'label_attributes' => [
                    'class' => 'col-md-12',
                ],

            ],
            [
                'value' => AbstractNestedSet::INSERT_NODE,
                'label' => 'Insert after.',
                'label_attributes' => [
                    'class' => 'col-md-12',
                ],

            ],
            [
                'value' => AbstractNestedSet::INSERT_CHILD,
                'label' => 'Insert as a sub-page.',
                'label_attributes' => [
                    'class' => 'col-md-12',
                ],

            ],
        ];

        $this->setValueOptions($valueOptions);

        $this->setValue('noInsert');
    }
}
