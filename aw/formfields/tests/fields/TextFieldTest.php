<?php

/**
 * TextField PHPUnit Test case
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
 * TextField PHPUnit Test case
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
class TextFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * Text field
     * 
     * @var \aw\formfields\fields\TextField
     */
    public $textField;

    /**
     * Setup a new text field object with each test
     * 
     * @return void
     */
    public function setUp()
    {
        $this->textField = new \aw\formfields\fields\TextField(
            'textfield', 
            array(
                'id' => 'textfield',
                'class' => 'textfield'
            )
        );

        // Add a value to the text field
        $this->textField->setValue('A Value');

        // Add another class
        $this->textField->addClass('testing');
    }

    /**
     * Test textfield object
     * 
     * @return void
     */
    public function testNewTextField()
    {
        $this->assertEquals('textfield', $this->textField->getId());
        $this->assertEquals('textfield testing', $this->textField->getClass());

        // Remove the class attribute
        $this->textField->popAttribute('class');

        // Test the output
        $this->assertEquals('<input type="text" id="textfield" name="textfield" value="A Value">', (string) $this->textField);

        // Change the id field
        $this->textField->setId('newId');

        // Test the output
        $this->assertEquals('<input type="text" id="newId" name="textfield" value="A Value">', (string) $this->textField);

        // Test that the text field is not required to be tested at the
        // moment
        $this->assertFalse($this->textField->isRequired());
    }

    /**
     * Test textfield validation
     * 
     * @return void
     */
    public function testTextFieldValidation()
    {
        $this->textField->setRule('Valid');
        $this->assertFalse($this->textField->isRequired());

        $this->textField->getRule()->setRequired(true);
        $this->assertTrue($this->textField->isRequired());

        // Add a value to the text field
        $this->textField->setValue('Another value');
        $this->assertEquals('Another value', $this->textField->getValue());
        $this->assertEquals('Another value', $this->textField->getRule()->getValue());

        // Test validation
        $this->assertTrue($this->textField->getRule()->validateNull());
        $this->assertTrue($this->textField->getRule()->validateString());
        $this->assertTrue($this->textField->getRule()->validateString(5));
        $this->assertFalse($this->textField->getRule()->validateString(50));
        $this->assertFalse($this->textField->getRule()->validateString(5, 8));

        // Set value to be null
        $this->textField->setValue(null);
        $this->assertFalse($this->textField->getRule()->validateString());
    }
}