<?php

/**
 * Unit test for parent/child relationships
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
 * Unit test for parent/child relationships
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
class ParentChildTest extends PHPUnit_Framework_TestCase
{
    /**
     * Form variable
     * 
     * @var \aw\formfields\forms\Form
     */
    public $form;
    
    /**
     * Create a new parent/child object
     * 
     * @return void
     */
    public function setUp()
    {
        $this->form = \aw\formfields\forms\BrochureForm::factory();
    }
    
    /**
     * Test child traversal 
     * 
     * @return void
     */
    public function testChildren()
    {
        $this->assertEquals(4, count($this->form->getChildren()));
    }
    
    /**
     * Test child removal
     * 
     * @return void
     */
    public function testRemoveChild()
    {
        $submit = $this->form->getElementBy('getType', 'submit')->remove();
        $this->assertEquals(3, count($this->form->getChildren()));
        $this->assertEquals(
            $submit->render(),
            '<input type="submit" value="Submit Form">'
        );
    }
    
    /**
     * Test child swapping
     * 
     * Move the submit item to be between the second and last fieldsets
     * 
     * @return void
     */
    public function testMoveChild()
    {
        $this->form->getElementBy('getType', 'submit')->moveUp();
        $this->assertEquals(4, count($this->form->getChildren()));
        $this->assertEquals(
            2,
            $this->form->getElementBy('getType', 'submit')->getIndex()
        );
    }
    
    /**
     * Test child more child removal
     * 
     * Remove a option from the title select field.  We could just call
     * $this->form->getElementBy('getValue', 'Rev')->remove() but this is
     * to demonstrate the element chaining.
     * 
     * @return void
     */
    public function testRemoveOptionFromSelect()
    {
        $this->form->getElementBy('getId', 'title')->getElementBy('getValue', 'Rev')->remove();
        $this->assertEquals(
            '<select id="title" name="title"><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Miss">Miss</option><option value="Ms">Ms</option><option value="Dr">Dr</option><option value="Prof">Prof</option></select>',
            $this->form->getElementBy('getId', 'title')->render()
        );
    }
    
}