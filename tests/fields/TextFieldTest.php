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

require_once '../autoload.php';

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
     * @var \aw\formfields\fields\TextInput
     */
    public $textField;

    /**
     * Setup a new text field object with each test
     * 
     * @return void
     */
    public function setUp()
    {
        $this->textField = new \aw\formfields\fields\TextInput(
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

        // Add simple validation
        $this->textField->setRule('ValidString');
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


        $textField2 = new \aw\formfields\fields\TextInput(
            'textfield', 
            array(
                'id' => 'textfield',
                'class' => 'textfield'
            )
        );
        // Test that the text field is not required to be tested at the
        // moment
        $this->assertFalse($textField2->isRequired());
    }

    /**
     * Test textfield validation
     * 
     * @return void
     */
    public function testTextFieldValidation()
    {
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
        $this->assertTrue($this->textField->getRule()->validate());
    }

    /**
     * Test that an exception is thrown when a non existent method is called
     * 
     * @expectedException \RuntimeException
     * 
     * @return void
     */
    public function testNonExistentMethod()
    {
        $this->textField->foo();
    }
    
    /**
     * Test email validation
     * 
     * @return void
     */
    public function testEmailValidation()
    {
        $this->textField->setRule('ValidEmail')->setValue('email@example.com')->getRule()->validate();
    }

    /**
     * Test that an exception is thrown on slug validation failure
     * 
     * @dataProvider slugValidationProvider
     * 
     * @return void
     */
    public function testTextFieldValidationExceptionCode(
        $rule,
        $value,
        $code,
        $message,
        $toString
    ) {
        try {
            $this->textField->setRule($rule)->setValue($value)->getRule()->validate();
        } catch (\aw\formfields\validation\ValidationException $ex) {
            $this->assertEquals($code, $ex->getCode());
            $this->assertEquals($message, $ex->getMessage());
            $this->assertEquals($toString, (string) $ex);
        }
    }
    
    /**
     * Return slug validation provision
     * 
     * @return array
     */
    public function slugValidationProvider()
    {
        return array(
            array(
                'Valid',
                null,
                1000,
                'Required',
                'aw\formfields\validation\ValidationException: [1000]: Required'
            ),
            array(
                'ValidString',
                '',
                1001,
                'Required',
                'aw\formfields\validation\ValidationException: [1001]: Required'
            ),
            array(
                'ValidEmail',
                '',
                1001,
                'Required',
                'aw\formfields\validation\ValidationException: [1001]: Required'
            ),
            array(
                'ValidEmail',
                'email@',
                1002,
                'Invalid email address',
                'aw\formfields\validation\ValidationException: [1002]: Invalid email address'
            ),
            array(
                'ValidEmail',
                'invalidemail',
                1002,
                'Invalid email address',
                'aw\formfields\validation\ValidationException: [1002]: Invalid email address'
            ),
            array(
                'ValidSlug',
                '',
                1001,
                'Required',
                'aw\formfields\validation\ValidationException: [1001]: Required'
            ),
            array(
                'ValidSlug',
                null,
                1000,
                'Required',
                'aw\formfields\validation\ValidationException: [1000]: Required'
            ),
            array(
                'ValidSlug',
                'S*&(s8978f-',
                1005,
                'Alpha/Numeric characters only',
                'aw\formfields\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            ),
            array(
                'ValidSlug',
                'DFDSFDS)(*DF^(',
                1005,
                'Alpha/Numeric characters only',
                'aw\formfields\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            ),
            array(
                'ValidSlug',
                'DFDSFDS',
                1005,
                'Alpha/Numeric characters only',
                'aw\formfields\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            ),
            array(
                'ValidSlug',
                '____',
                1005,
                'Alpha/Numeric characters only',
                'aw\formfields\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            ),
            array(
                'ValidSlug',
                '--__',
                1005,
                'Alpha/Numeric characters only',
                'aw\formfields\validation\ValidationException: [1005]: Alpha/Numeric characters only'
            )
        );
    }
}