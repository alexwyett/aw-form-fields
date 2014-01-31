<?php

/**
 * Submit Button PHPUnit Test case
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
 * Submit Button PHPUnit Test case
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
class SubmitButtonTest extends PHPUnit_Framework_TestCase
{
    /**
     * Submit Button
     * 
     * @var \aw\formfields\fields\SubmitButton
     */
    public $sb;

    /**
     * Setup a new submit button to test
     * 
     * @return void
     */
    public function setUp()
    {
        $this->sb = new \aw\formfields\fields\SubmitButton(
            array(
                'id' => 'submitButton',
                'class' => 'submitButton'
            )
        );

        // Add a value to the button
        $this->sb->setValue('Press Me');
    }

    /**
     * Test submit button object
     * 
     * @return void
     */
    public function testNewSubmitButton()
    {
        $this->assertEquals('submitButton', $this->sb->getId());
        $this->assertEquals(
            '<input type="submit" id="submitButton" class="submitButton" value="Press Me">',
            $this->sb->render()
        );
    }
}