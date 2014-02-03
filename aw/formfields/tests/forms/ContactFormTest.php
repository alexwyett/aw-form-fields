<?php

/**
 * Contact Form Object PHPUnit Test case
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
 * Contact Form Object PHPUnit Test case
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
class ContactFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * New form creation
     * 
     * @return void
     */
    public function testNewForm()
    {
        // Create a new form
        $form = aw\formfields\forms\ContactForm::factory();
        
        // Test render
        $this->assertEquals(
            $this->removeWhiteSpace(
                '<form>
                    <fieldset class="your-details">
                    <legend>Your Details</legend>
                    <label for="title">
                        Title
                        <select id="title" name="title">
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                            <option value="Ms">Ms</option>
                            <option value="Dr">Dr</option>
                            <option value="Prof">Prof</option>
                            <option value="Rev">Rev</option>
                        </select>
                    </label>
                    <label for="initial">Initial<input type="text" id="initial" name="initial"></label>
                    <label for="surname">Surname<input type="text" id="surname" name="surname"></label>
                    <label for="email">Email<input type="text" id="email" name="email"></label>
                    <label for="telephone">Telephone<input type="text" id="telephone" name="telephone"></label>
                    <label for="mobile">Mobile<input type="text" id="mobile" name="mobile"></label>
                    </fieldset>
                    <input type="submit" value="Submit Form">
                 </form>'
            ),
            $form->render()
        );
    }

    /**
     * Remove any new lines and whitepsace
     *
     * @param string $string String to remove whitespace from
     *
     * @return string
     */
    protected function removeWhiteSpace($string)
    {
        return preg_replace('/^\s+|\n|\r|\r\n\s+$/m', '', $string);
    }
}