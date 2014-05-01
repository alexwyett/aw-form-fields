<?php

/**
 * TOCC Advanced search form example
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
require_once 'ToccAdvancedSearch.php';

$form = new \aw\formfields\forms\ToccAdvancedSearch(
    array(), 
    $_GET
);

$form->setAreaSelect(
    $form->createBasicSelect(
        'Area', 
        array(
            'Any' => '',
            'Norfolk' => 'AREA',
            'Suffolk' => 'AREA1',
            'Kent' => 'AREA2'
        ),
        'area', 
        'areaAdv'
    )
);

$form->setLocationSelect(
    $form->createBasicSelect(
        'Location', 
        array(
            'Any' => '',
            'Southwold' => 'SOUTH',
            'Holt' => 'HOLT',
            'Reepham' => 'REEP'
        ),
        'location', 
        'locationAdv'
    )
);

$form->setSearchAttribute('Short Breaks', 'ATTR11')
    ->setSearchAttribute('Close to Coast', 'ATTR138')
    ->setSearchAttribute('Pet Friendly', 'pets')
    ->setSearchAttribute('Private Parking', 'ATTR30')
    ->setSearchAttribute('Internet Access', 'ATTR38')
    ->setSearchAttribute('Garden/Courtyard', 'ATTR06')
    ->setSearchAttribute('Near a Pub', 'ATTR139')
    ->setSearchAttribute('On One Level', 'ATTR12')
    ->setSearchAttribute('Short Breaks', 'shortbreaktemplate')
    ->setSearchAttribute('Special Offers', 'specialOffer')
    ->setSearchAttribute('New Properties', 'ATTR91')
    ->setSearchAttribute('Featured Properties', 'promote');

echo $form->build()->mapValues();