<?php

/**
 * Address form object
 *
 * PHP Version 5.3
 *
 * @category  Forms
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */

namespace aw\formfields\forms;

/**
 * Address form object.  Extends the generic form and provides a static helper
 * method to build the form object
 *
 * PHP Version 5.3
 * 
 * @category  Forms
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */
class AddressForm extends \aw\formfields\forms\Form
{
    /**
     * Constructor
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * @param array $countries  Countries in alpha2 => Name format
     * 
     * @return void
     */
    public static function factory(
        $attributes = array(),
        $formValues = array(),
        $countries = array()
    ) {
        // New form object
        $form = new \aw\formfields\forms\Form($attributes, $formValues);
        
        // Fieldset
        $fs = \aw\formfields\fields\Fieldset::factory(
            'Your Address',
            array(
                'class' => 'your-address'
            )
        );
        
        $formElements = array(
            'addr1' => array(
                'label' => 'House Name / Number',
                'rule' => 'ValidString',
                'required' => true
            ),
            'addr2' => array(
                'label' => 'Street name'
            ),
            'town' => array(
                'label' => 'Town / City',
                'rule' => 'ValidString',
                'required' => true
            ),
            'county' => array(
                'label' => 'County',
                'rule' => 'ValidString',
                'required' => true
            ),
            'postcode' => array(
                'label' => 'Post code',
                'rule' => 'ValidString',
                'required' => true
            )
        );
        
        foreach ($formElements as $name => $ele) {
            $label = new \aw\formfields\fields\Label(
                $ele['label'], 
                array('for' => $name)
            );

            $tf = new \aw\formfields\fields\TextInput(
                $name, 
                array(
                    'id' => $name
                )
            );

            // Add validation rule if required
            if (isset($ele['rule'])) {
                $tf->setRule($ele['rule'])
                    ->getRule()
                    ->setRequired(
                        (isset($ele['required']) && $ele['required'])
                    );
            }

            $fs->addChild(
                $label->addChild($tf)
            );
        }
        
        if (count($countries) > 0) {
            $label = new \aw\formfields\fields\Label(
                'Country', 
                array('for' => 'Country')
            );

            $sf = \aw\formfields\fields\SelectInput::factory(
                'country', 
                $countries,
                array(
                    'id' => 'country'
                )
            );

            // Add validation rule if required
            $sf->setRule('ValidString')->getRule()->setRequired(true);

            $fs->addChild(
                $label->addChild($sf)
            );
        }
        
        // Add fieldset to form
        $form->addChild($fs);
        
        // Add submit button
        $form->addChild(
            new \aw\formfields\fields\SubmitButton(
                array(
                    'value' => 'Submit Form'
                )
            )
        );
        
        return $form->mapValues();
    }
}