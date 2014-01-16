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
class TextareaTest extends PHPUnit_Framework_TestCase
{
    /**
     * textarea field
     * 
     * @var \aw\formfields\fields\Textarea
     */
    public $textarea;

    /**
     * Setup a new textarea field object with each test
     * 
     * @return void
     */
    public function setUp()
    {
        $this->textarea = new \aw\formfields\fields\Textarea(
            'textarea', 
            array(
                'id' => 'textarea',
                'class' => 'textarea'
            )
        );

        // Add a value to the textarea field
        $this->textarea->setValue('A Value');

        // Add another class
        $this->textarea->addClass('testing');
    }

    /**
     * Test textarea object
     * 
     * @return void
     */
    public function testNewTextarea()
    {
        $this->assertEquals('textarea', $this->textarea->getId());
        $this->assertEquals(
            '<textarea id="textarea" class="textarea testing" name="textarea">A Value</textarea>',
            $this->textarea->render()
        );
    }
}