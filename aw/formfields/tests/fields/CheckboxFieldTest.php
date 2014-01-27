<?php

/**
 * Checkbox Field PHPUnit Test case
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
 * Checkbox Field PHPUnit Test case
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
class CheckboxFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test checkbox object
     * 
     * @return void
     */
    public function testNewCheckbox()
    {
        $cb = $this->_getNewCheckbox();
        $this->assertEquals('myfunkycheckbox', $cb->getName());
        
        // Test the render
        $this->assertEquals(
            '<input type="checkbox" name="myfunkycheckbox">',
            (string) $cb
        );
        
        // Check the checkbox
        $cb->setChecked(true);
        
        // Test the render again
        $this->assertEquals(
            '<input type="checkbox" name="myfunkycheckbox" checked>',
            (string) $cb
        );
    }
    
    /**
     * Test checkbox object with a validation rule
     * 
     * @return void
     */
    public function testNewCheckboxWithRule()
    {
        $cb = $this->_getNewCheckbox();
        $cb->setRule('ValidCheckedState');
        
        // Check the checkbox
        $cb->setChecked(true);
        
        // Check that the checkbox is ticked
        $this->assertTrue($cb->isChecked());
        
        // Test that the rule has the same checked status
        $this->assertTrue($cb->getRule()->getValue());
        $this->assertTrue($cb->getRule()->validate());
    }
    
    /**
     * Test checkbox object with a validation rule
     * 
     * @expectedException \aw\formfields\validation\ValidationException
     * 
     * @return void
     */
    public function testNewCheckboxWithRuleThrowsException()
    {
        $this->_getNewCheckbox()
                ->setRule('ValidCheckedState')
                ->getRule()->validateChecked();
    }
    
    /**
     * Return a new checkbox object
     * 
     * @return \aw\formfields\fields\Checkbox
     */
    private function _getNewCheckbox()
    {
        return new \aw\formfields\fields\Checkbox('myfunkycheckbox');
    }
}