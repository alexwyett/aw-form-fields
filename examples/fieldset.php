<?php

/**
 * Fieldset example
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
require_once 'label.php';

// Clean the output buffer from last eg
ob_clean();

// Instantiate a fielset
$fs = new \aw\formfields\fields\Fieldset();

// Output fieldset
echo $fs->addChild($lbl);