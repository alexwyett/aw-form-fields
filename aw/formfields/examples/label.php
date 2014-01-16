<?php

/**
 * Label & text field example
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
require_once 'textfield.php';

// Clean the output buffer from last eg
ob_clean();

// Instantiate a new label
$lbl = new \aw\formfields\fields\Label('Name');

// Output label
echo $lbl;

// Instantiate a new label with attributes
$lbl = new \aw\formfields\fields\Label(
    'Name',
    array(
        'for' => 'name',
        'class' => 'label'
    )
);

// Add a child text field element
$lbl->addChild(
    // We can change the object properties here if we want to
    $tf3->setName('name')->setValue('Name')
);

// Output label
echo $lbl;