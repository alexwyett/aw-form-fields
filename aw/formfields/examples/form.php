<?php

/**
 * Form example
 *
 * PHP Version 5.3
 *
 * @category  FormFields
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */

// Include autoloader
require_once 'selectfield.php';

$sf->setRule('Valid');

// Reset the output buffer
ob_clean();

// Create new form
$form = new \aw\formfields\forms\Form();
$form->addChild($sf);

// Output
echo $form->validate();

// Test a new form which store submitted values
$form2 = new \aw\formfields\forms\Form(array(), $_GET);
$form2->addChild($sf2);

// Add radio buttons
$form2->addChild(
    new \aw\formfields\fields\RadioButton(
        'number',
        array('value' => 'one')
    )
);
$form2->addChild(
    new \aw\formfields\fields\RadioButton(
        'number',
        array('value' => 'two')
    )
);

$form2->addChild(
    new \aw\formfields\fields\SubmitButton(
        array(
            'value' => 'Submit Form'
        )
    )
);

// Output new form
echo $form2->mapValues();