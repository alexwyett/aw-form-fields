<?php

/**
 * Text field example
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
require_once '../autoload.php';

// Instantiate a new text field
$tf = new \aw\formfields\fields\TextInput('test');

// Output field
echo $tf;

// Instantiate a new text field with attributes
$tf2 = new \aw\formfields\fields\TextInput(
    'test2',
    array(
        'class' => 'testClass',
        'value' => 'Test2'
    )
);

// Output field
echo $tf2;

// Check value
echo $tf2->getValue();

// Instantiate a new text field to validate
$tf3 = new \aw\formfields\fields\TextInput('test');
$tf3->setRule('ValidString')->setValue('Test 3');

// Outputs false as value is now set
var_dump($tf3->getRule()->validate());

// Output field
echo $tf3;