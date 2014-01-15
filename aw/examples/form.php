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

$sf->setValidationRule(
    \aw\formfields\validation\Valid::factory(true)
);

// Reset the output buffer
ob_clean();

// Create new form
$form = new \aw\formfields\forms\Form();
$form->addChild($sf);


// Output
echo $form->validate();