<?php

/**
 * Image Button PHPUnit Test case
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
class ImageButtonTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test image button object
     * 
     * @return void
     */
    public function testNewImageButton()
    {
        $ib = new aw\formfields\fields\ImageButton('mybutton.gif');
        $this->assertEquals('mybutton.gif', $ib->getSrc());
        $this->assertEquals(
            '<input type="image" src="mybutton.gif">',
            $ib->render()
        );
    }
}