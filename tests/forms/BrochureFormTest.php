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

require_once 'ContactFormTest.php';

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
class BrochureFormTest extends ContactFormTest
{
    /**
     * New form creation
     * 
     * @return void
     */
    public function testNewForm()
    {
        // Create a new form
        $form = \aw\formfields\forms\BrochureForm::factory(
            array(), 
            $_GET,
            array(
                'Select' => '',
                'United Kingdom' => 'GB'
            ),
            array(
                'Select' => '',
                'Google Ads' => 'GOO',
                'Other Search Engine' => 'SRCH',
                'Newspaper' => 'NEW'
            )
        );
        
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
                    <fieldset class="your-address">
                        <legend>Your Address</legend>
                        <label for="addr1">House Name / Number<input type="text" id="addr1" name="addr1"></label>
                        <label for="addr2">Street name<input type="text" id="addr2" name="addr2"></label>
                        <label for="town">Town / City<input type="text" id="town" name="town"></label>
                        <label for="county">County<input type="text" id="county" name="county"></label>
                        <label for="postcode">Post code<input type="text" id="postcode" name="postcode"></label>
                        <label for="Country">Country<select id="country" name="country"><option value="">Select</option><option value="GB" selected="selected">United Kingdom</option></select></label>
                    </fieldset>
                    <fieldset class="optional-details">
                        <legend>Optional Details</legend>
                        <label for="emailoptin">Please tick here if you would like to here about our special offers<input type="checkbox" id="emailoptin" name="emailoptin"></label>
                        <label for="where-did-you-here-about-us">Where did you here about us?<select id="where-did-you-here-about-us" name="source"><option value="" selected="selected">Select</option><option value="GOO">Google Ads</option><option value="SRCH">Other Search Engine</option><option value="NEW">Newspaper</option></select></label>
                    </fieldset>
                    <input type="submit" value="Submit Form">
                </form>'
            ),
            $form->render()
        );
    }
}