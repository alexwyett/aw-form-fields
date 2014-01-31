<?php

/**
 * Textarea example
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
$ta = new \aw\formfields\fields\Textarea('test');

// Output field
echo $ta;

// Instantiate a new text area field with attributes
$tf2 = new \aw\formfields\fields\Textarea(
    'test2',
    array(
        'class' => 'testClass',
        'value' => 'Test'
    )
);

// Output field
echo $tf2;