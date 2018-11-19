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
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Form;

/**
 * Class Menu
 * @package UthandoNavigation\Form
 */
class MenuForm extends Form
{
	public function init()
    {
        $this->add([
            'name' => 'menu',
            'type' => Text::class,
            'options' => [
                'label' => 'Menu Title',
                'required' => true,
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
            ],
            'attributes' => [
                'placeholder' => 'Menu Title',
            ],
        ]);

        $this->add([
            'name' => 'menuId',
            'type' => Hidden::class,
        ]);


        $this->add([
            'name' => 'security',
            'type' => Csrf::class,
        ]);
    }
}
