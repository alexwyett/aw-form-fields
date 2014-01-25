<?php

/**
 * Fieldset and Legend object test cases
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

require_once '../../autoload.php';

/**
 * Fieldset and Legend object test cases
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
class FieldsetAndLegendTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test factory method
     * 
     * @return void
     */
    public function testFieldsetCollection()
    {
        $textfield = new \aw\formfields\fields\TextField('mytextfield');
        $fs = \aw\formfields\fields\Fieldset::factory('Test Fieldset', array(), array($textfield));
        $this->assertEquals(
            '<fieldset><legend>Test Fieldset</legend><input type="text" name="mytextfield"></fieldset>',
            (string) $fs
        );

        // Get a child element by its accessor
        $elements = $fs->getElementBy('getName', 'mytextfield');
        $this->assertEquals(1, count($elements));
        $this->assertEquals('mytextfield', $elements[0]->getName());
    }
}