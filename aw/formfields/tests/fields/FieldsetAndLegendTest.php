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

require_once '../autoload.php';

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
        $fs = \aw\formfields\fields\Fieldset::factory(
            'Test Fieldset', 
            array(), 
            array(
                new \aw\formfields\fields\TextInput('mytextfield'), 
                new \aw\formfields\fields\TextInput('mytextfield2')
            )
        );
        
        $this->assertEquals(
            '<fieldset><legend>Test Fieldset</legend><input type="text" name="mytextfield"><input type="text" name="mytextfield2"></fieldset>',
            (string) $fs
        );

        // Get a child element by its accessor
        $element = $fs->getElementBy('getName', 'mytextfield');
        $this->assertEquals('mytextfield', $element->getName());

        // Get a single child element by its accessor
        $element = $fs->getElementBy('getName', 'mytextfield', 0);
        $this->assertEquals('mytextfield', $element->getName());

        // Get multiple elements
        $elements = $fs->getElementBy('getType', 'text');
        $this->assertEquals(2, count($elements));        
        
        // Test the each function
        $fs->each('getName', 'mytextfield', function($ele) {
            $ele->setValue('test');
        });
        $this->assertEquals(
            '<fieldset><legend>Test Fieldset</legend><input type="text" name="mytextfield" value="test"><input type="text" name="mytextfield2"></fieldset>',
            (string) $fs
        );

    }
    
    /**
     * Test positioning of child elements using moveUp or moveDown
     * 
     * @return void
     */
    public function testObjectPositioning()
    {
        $fs = \aw\formfields\fields\Fieldset::factory(
            'Test Fieldset', 
            array(), 
            array(
                new \aw\formfields\fields\TextInput('mytextfield'), 
                new \aw\formfields\fields\TextInput('mytextfield2'),
                new \aw\formfields\fields\TextInput('mytextfield3'),
                new \aw\formfields\fields\TextInput('mytextfield4'),
                new \aw\formfields\fields\TextInput('mytextfield5')
            )
        );
        
        
        // Test the index of the fieldset
        $this->assertEquals(
            0,
            $fs->getIndex()
        );
        
        
        $this->assertEquals(
            $fs->getElementBy('getIndex', 3)->getName(),
            'mytextfield3'
        );
        
        // Move on up
        $fs->getElementBy('getIndex', 3)->moveUp();
        
        // Test the index is ok
        $this->assertEquals(
            $fs->getElementBy('getIndex', 2)->getName(),
            'mytextfield3'
        );
        
        // Move down twice
        $fs->getElementBy('getIndex', 2)->moveDown()->moveDown();
        
        // Test the index is ok
        $this->assertEquals(
            $fs->getElementBy('getIndex', 4)->getName(),
            'mytextfield3'
        );
    }
}