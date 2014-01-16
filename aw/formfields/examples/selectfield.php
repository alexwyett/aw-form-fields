<?php

/**
 * Select field example
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
require_once '../../autoload.php';

// Instantiate a new text area field
$sf = new \aw\formfields\fields\SelectField('test');

// Add a option
$sf->addChild(
    new \aw\formfields\fields\Option('Select', '')
);

// Output field
echo $sf;

// Try out the factory method with a selected value
$sf2 = \aw\formfields\fields\SelectField::factory(
    'test2',
    array(
        'Select' => '',
        'One' => 1,
        'Two' => 2,
        'Three' => 3,
        'Four' => 4,
        'Five' => 5,
        'Six' => array(
            'value' => 6,            // Accepts arrays for additional
            'style' => 'color: red;' // option attributes too
        ),
        'Seven' => 7,
        'Eight' => 8,
        'Nine' => 9,
        'Ten' => 10,
    ),
    array(),
    '7'
);

// Output field
echo $sf2;