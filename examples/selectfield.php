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
require_once '../autoload.php';

// Instantiate a new text area field
$sf = new \aw\formfields\fields\SelectInput('test');

// Add a option
$sf->addChild(
    new \aw\formfields\fields\Option('Select', '')
);

// Output field
echo $sf;

// Try out the factory method with a selected value
$sf2 = \aw\formfields\fields\SelectInput::factory(
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

// Try removing an option
echo $sf2->getChild(1)->remove();

// Try out the factory method several optgroups
$sf3 = \aw\formfields\fields\SelectInput::factory(
    'test3',
    array(
        'Select' => '',
        \aw\formfields\fields\Optgroup::factory(
            'Colours',
            array(
                'Red' => 'red',
                'Orange' => 'orange',
                'Yellow' => 'yellow',
                'Green' => 'green',
                'Blue' => 'blue',
                'Indigo' => 'indigo',
                'Violet' => 'violet'
            )
        ),
        \aw\formfields\fields\Optgroup::factory(
            'Numbers',
            array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10'
            )
        )
    ),
    array(),
    'red'
);

// Output field
echo $sf3;