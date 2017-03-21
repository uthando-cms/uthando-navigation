<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Form
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNavigation\Form;

use TwbBundle\Form\View\Helper\TwbBundleForm;
use Zend\Form\Form;

/**
 * Class MenuItem
 * @package UthandoNavigation\Form
 */
class MenuItem extends Form
{
	public function init()
	{
		$this->add([
			'name' => 'label',
			'type' => 'text',
			'options' => [
				'label' => 'Label',
				'required' => true,
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
			],
			'attributes' =>[
				'placeholder' => 'Label',
			],
		]);
		
		$this->add([
			'name' => 'params',
			'type' => 'textarea',
			'options' => [
				'label' => 'Params',
				'required' => false,
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
			],
			'attributes' => [
				'placeholder' => 'Params',
			],
		]);
		
		$this->add([
			'name' => 'route',
			'type' => 'RouteList',
			'options' => [
				'label' => 'Route',
				'required' => false,
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
			],
		]);
		
		$this->add([
			'name' => 'resource',
			'type' => 'ResourceList',
			'options' => [
				'label' => 'Resource',
				'required' => false,
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
			],
			'attributes' => [
				'placeholder' => 'Resource:',
			],
		]);
		
		$this->add([
			'name' => 'visible',
			'type' => 'select',
			'options' => [
				'label' => 'Is Visible',
				'required' => true,
				'empty_option' => '---Please select option---',
				'value_options' => [
					'0'	=> 'No',
					'1'	=> 'Yes',
				],
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
			],
		]);

        $this->add([
            'name' => 'position',
            'type' => 'MenuItemList',
            'options' => [
                'label' => 'Menu Placement',
                'required' => false,
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
            ],
        ]);

        $this->add([
            'name' => 'menuInsertType',
            'type' => 'MenuItemRadio',
            'options' => [
                'label' => 'Insert Type',
                'required' => false,
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
            ],
        ]);

        $this->add([
            'name' => 'menuItemId',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'menuId',
            'type' => 'hidden',
        ]);


        $this->add([
            'name' => 'security',
            'type' => 'csrf',
        ]);
	}
}
