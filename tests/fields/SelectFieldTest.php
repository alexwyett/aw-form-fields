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

require_once '../autoload.php';

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
     * @var \aw\formfields\fields\SelectInput
     */
    public $selectField;

    /**
     * Setup a new text field object with each test
     * 
     * @return void
     */
    public function setUp()
    {
        $this->selectField = \aw\formfields\fields\SelectInput::factory(
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

        // Add simple validation
        $this->selectField->setRule('ValidNumber');
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

        // Test validation
        $this->assertNull($this->selectField->getRule()->validateNull());
        $this->assertNull($this->selectField->getRule()->validateNumber());
        $this->assertNull($this->selectField->getRule()->validate());
        
        // Test parent function
        $this->assertEquals('2', $this->selectField->getElementBy('getValue', 2, 1)->getParent()->getValue());
    }

    /**
     * Test a select field with no children
     * 
     * @return void
     */
    public function testEmptySelect()
    {
        $select = new \aw\formfields\fields\SelectInput('selectfield2');
        $this->assertEquals('', $select->renderChildren());
        $this->assertEquals('', $select->getValue());
        $this->assertNull($select->getSelected());

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

    /**
     * Test a select field with no children
     * 
     * @return void
     */
    public function testOptgroupSelect()
    {
        $select = new \aw\formfields\fields\SelectInput('selectfield3');

        // Create a new option
        $op = new \aw\formfields\fields\Option('Select', '');
        $op1 = new \aw\formfields\fields\Option('1', '1');
        $op2 = new \aw\formfields\fields\Option('2', '2');
        $optg = new \aw\formfields\fields\Optgroup('Options');
        $select->addChild($optg->addChildren(array($op, $op1, $op2)));

        $this->assertEquals(
            '<select name="selectfield3"><optgroup label="Options"><option value="">Select</option><option value="1">1</option><option value="2">2</option></optgroup></select>', 
            $select->render()
        );
    }

    /**
     * Test that an exception is thrown on validation failure
     * 
     * @expectedException \aw\formfields\validation\ValidationException
     * 
     * @return void
     */
    public function testSelectFieldValidationNullException()
    {
        // Set value to be null
        $this->selectField->setValue(null)->getRule()->validateNull();
    }

    /**
     * Test that an exception is thrown on string validation failure
     * 
     * @expectedException \aw\formfields\validation\ValidationException
     * 
     * @return void
     */
    public function testSelectFieldValidationNumberException()
    {
        // Set value to be empty string
        $this->selectField->setValue('')->getRule()->validateNumber();
    }

    /**
     * Test that an exception is thrown on string validation failure
     * 
     * @dataProvider selectValidationProvider
     * 
     * @return void
     */
    public function testSelectFieldValidationNumberExceptionCode(
        $value,
        $code,
        $message,
        $toString
    ) {
        try {
            // Set value to be empty string
            $this->selectField->setValue($value)->getRule()->validate();
        } catch (\aw\formfields\validation\ValidationException $ex) {
            $this->assertEquals($code, $ex->getCode());
            $this->assertEquals($message, $ex->getMessage());
            $this->assertEquals($toString, (string) $ex);
        }
    }
    
    /**
     * Return select validation provision
     * 
     * @return array
     */
    public function selectValidationProvider()
    {
        return array(
            array(
                '',
                1004,
                'Not a number',
                'aw\formfields\validation\ValidationException: [1004]: Not a number'
            ),
            array(
                null,
                1000,
                'Required',
                'aw\formfields\validation\ValidationException: [1000]: Required'
            )
        );
    }
}