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
require_once '../autoload.php';

$form = \aw\formfields\forms\ContactForm::factory(array(), $_GET);

// Apply a different template to each of the labels
$form->each('getType', 'label', function($label) {
    $label->setTemplate(
        '<div class="row">'
            . '<div class="col">'
            . ' <label{implodeAttributes}>{getLabel}</label>'
            . '</div>'
            . '<div class="col">'
            . '{renderChildren}'
            . '</div>'
        . '</div>'
    );
});

// Add another wrapper around title, initial, surname
$form->getElementBy('getName', 'title')->getParent()->prependTemplate(
    '<div class="row name">'
);

// Add another wrapper around title, initial, surname
$form->getElementBy('getName', 'surname')->getParent()->appendTemplate(
    '</div>'
);

if (count($_GET)) {
    echo $form->validate();
} else {
    echo $form;
}