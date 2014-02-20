<?php

/**
 * Brochure form object
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
 * Brochure form object.  Users Customer form and address form to create a 
 * super form!
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
class BrochureForm extends \aw\formfields\forms\StaticForm
{
    /**
     * Constructor
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * @param array $countries  Countries in alpha2 => Name format
     * @param array $countries  Array of sources in Code => Name format
     * 
     * @return void
     */
    public static function factory(
        $attributes = array(),
        $formValues = array(),
        $countries = array(),
        $sources = array()
    ) {
        // New form object
        $form = new \aw\formfields\forms\Form($attributes, $formValues);
        
        $contactform = ContactForm::factory();
        $form->addChild($contactform->getElementBy('getType', 'fieldset'));
        
        $addressform = AddressForm::factory(array(), array(), $countries);
        $form->addChild($addressform->getElementBy('getType', 'fieldset'));

        // Set the value of the country field to default to UK
        if (count($countries) > 0) {
            $form->getElementBy('getName', 'country')->setValue('GB');
        }
        
        // Fieldset
        $fs = \aw\formfields\fields\Fieldset::factory(
            'Optional Details',
            array(
                'class' => 'optional-details'
            )
        );
        
        $fs->addChild(
            self::getNewLabelAndCheckboxField(
                'Please tick here if you would like to here about our special offers'
            )->setAttribute('for', 'emailoptin')
                ->getElementBy('getType', 'checkbox')
                ->setName('emailoptin')
                ->setid('emailoptin')
                ->getParent()
        );
        
        if (count($sources) > 0) {
            $fs->addChild(
                \aw\formfields\forms\ContactForm::getNewLabelAndSelect(
                    'Where did you here about us?', 
                    $sources,
                    'ValidString',
                    true
                )->getElementBy('getType', 'select')
                    ->setName('source')
                    ->getParent()
            );
        } else {
            $fs->addChild(
                new \aw\formfields\fields\HiddenInput(
                    'source',
                    array(
                        'value' => 'OTH'
                    )
                )
            );
            $fs->addChild(
                \aw\formfields\forms\ContactForm::getNewLabelAndTextField(
                    'Where did you here about us?',
                    'ValidString',
                    true
                )->getElementBy('getType', 'text')
                    ->setName('other')
                    ->getParent() // Need to return the parent as the getElementBy
                                  // accessor returns the text field not the label
            );
        }
        
        // Add optional details form
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