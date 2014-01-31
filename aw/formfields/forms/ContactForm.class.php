<?php

/**
 * Contact form object
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
 * Contact form object.  Extends the generic form and provides a static helper
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
class ContactForm extends \aw\formfields\forms\Form
{
    /**
     * Constructor
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * 
     * @return void
     */
    public static function factory(
        $attributes = array(),
        $formValues = array()
    ) {
        // New form object
        $form = new \aw\formfields\forms\Form($attributes, $formValues);
        
        // Fieldset
        $fs = \aw\formfields\fields\Fieldset::factory(
            'Your Details',
            array(
                'class' => 'your-details'
            )
        );
        
        // Start creating/adding fields and adding them to the fieldset
        $label = new \aw\formfields\fields\Label(
            'Title', 
            array('for' => 'title')
        );
        $label->addChild(
            self::getTitleSelect()
        );
        $fs->addChild($label);
        
        // Add initials
        $label = self::_getNewLabelAndTextField('Initial');
        $fs->addChild($label);
        
        // Add surname
        $label = self::_getNewLabelAndTextField('Surname', 'ValidString', true);
        $fs->addChild($label);
        
        // Add email
        $label = self::_getNewLabelAndTextField('Email', 'ValidEmail');
        $fs->addChild($label);
        
        // Add telephone
        $label = self::_getNewLabelAndTextField('Telephone', 'ValidString', true);
        $fs->addChild($label);
        
        // Add mobile telephone
        $label = self::_getNewLabelAndTextField('Mobile');
        $fs->addChild($label);
        
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
    
    /**
     * Return a select field with all the normal titles
     * 
     * @return \aw\formfields\fields\Select
     */
    public static function getTitleSelect()
    {
        return \aw\formfields\fields\SelectInput::factory(
            'title', 
            array(
                'Mr' => 'Mr',
                'Mrs' => 'Mrs',
                'Miss' => 'Miss',
                'Ms' => 'Ms',
                'Dr' => 'Dr',
                'Prof' => 'Prof',
                'Rev' => 'Rev',
            ),
            array(
                'id' => 'title'
            )
        );
    }
    
    /**
     * Create a new label and child texst field
     * 
     * @param \aw\formfields\fields\Label $label          Label name
     * @param string                      $validationRule Name of the validation
     * rule thats required to validate the field
     * @param boolean                     $required       Set to true if the 
     * rule is required or not
     * 
     * @return \aw\formfields\fields\Label
     */
    private static function _getNewLabelAndTextField(
        $label,  
        $validationRule = null,
        $required = false
    ) {
        $name = self::slugify($label, '_');
        $label = new \aw\formfields\fields\Label(
            $label, 
            array('for' => $name)
        );

        $tf = new \aw\formfields\fields\TextInput(
            $name, 
            array(
                'id' => $name
            )
        );

        // Add validation rule if required
        if ($validationRule) {
            $tf->setRule($validationRule)
                ->getRule()
                ->setRequired($required);
        }

        return $label->addChild($tf);
    }
}