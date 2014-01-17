<?php

/**
 * Contact Form example
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

$form = \aw\formfields\forms\ContactForm::factory(array(), $_GET);

if (count($_GET)) {
    echo $form->validate();
} else {
    echo $form;
}