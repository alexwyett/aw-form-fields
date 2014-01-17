<?php

/**
 * SelectField PHPUnit Test case
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
 * SelectField PHPUnit Test case
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
class SelectFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * Select field
     * 
     * @var \aw\formfields\fields\SelectField
     */
    public $selectField;

    /**
     * Setup a new text field object with each test
     * 
     * @return void
     */
    public function setUp()
    {
        $this->selectField = \aw\formfields\fields\SelectField::factory(
            'selectfield',
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
    }

    /**
     * Test select field object
     * 
     * @return void
     */
    public function testNewSelectField()
    {
        // Test basics
        $this->assertEquals('selectfield', $this->selectField->getName());
        $this->assertEquals('7', $this->selectField->getValue());
        $this->assertTrue($this->selectField->hasChildren());
        $this->assertEquals('<option value="">Select</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option><option value="4">Four</option><option value="5">Five</option><option value="6" style="color: red;">Six</option><option value="7" selected="selected">Seven</option><option value="8">Eight</option><option value="9">Nine</option><option value="10">Ten</option>', $this->selectField->renderChildren());

        // Set new value
        $this->selectField->setValue(null);
        $this->assertEquals('', $this->selectField->getValue());

        // Set new value
        $this->selectField->setValue(2);
        $this->assertEquals('2', $this->selectField->getValue());
        $this->assertEquals('Two', $this->selectField->getSelected()->getDisplayValue());
    }

    /**
     * Test a select field with no children
     * 
     * @return void
     */
    public function testEmptySelect()
    {
        $select = new \aw\formfields\fields\SelectField('selectfield2');
        $this->assertEquals('', $select->renderChildren());

        // Create a new option
        $op = new \aw\FormFields\fields\Option('Select', '');
        $select->addChildren(array($op));
        $this->assertEquals(
            '<select name="selectfield2"><option value="">Select</option></select>', 
            $select->render()
        );
        
        $op2 = $select->getChild(0);
        $this->assertEquals('Select', $op2->getDisplayValue());
    }
}