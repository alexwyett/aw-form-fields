<?php

/**
 * Form Object PHPUnit Test case
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
 * Form Object PHPUnit Test case
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
class FormTest extends PHPUnit_Framework_TestCase
{
    /**
     * New form creation
     * 
     * @return void
     */
    public function testNewForm()
    {
        // Create a new form
        $form = new aw\formfields\forms\Form();
        
        // Test render
        $this->assertEquals('<form></form>', $form->render());
        
        // Test static methods and add to form
        $form->addChildren(
            array(
                \aw\formfields\forms\StaticForm::getNewLabelAndTextArea(
                    'Textarea'
                ),
                \aw\formfields\forms\StaticForm::getNewLabelAndTextField(
                    'TextInput'
                ),
                \aw\formfields\forms\StaticForm::getNewLabelAndCheckboxField(
                    'Checkbox'
                ),
            )
        );
        
        // Test textarea
        $this->assertEquals(
            'Textarea', 
            $form->getElementBy('getType', 'label', 0)->getLabel()
        );
        
        // Test textarea
        $this->assertEquals(
            'textarea', 
            $form->getElementBy('getType', 'textarea')->getType()
        );
    }
    
    /**
     * Slug function test
     * 
     * @return void
     */
    public function testSlugFunction()
    {
        $this->assertEquals(
            'a-pinata-is-a-paper-container-filled-with-candy',
            \aw\formfields\forms\Form::slugify(
                'A piñata is a paper container filled with candy'
            )
        );
    }
    
    /**
     * Map Values function test
     * 
     * @return void
     */
    public function testMapValues()
    {
        $brochureForm = \aw\formfields\forms\BrochureForm::factory(
            array(), 
            array(
                'addr1' => '1 anywhere road',
                'town' => 'Somehwere',
                'county' => 'In the middle',
                'postcode' => 'OFN0WRE',
                'emailoptin' => 'on'
            ), 
            array(
                'Select' => '',
                'United Kingdom' => 'GB'
            )
        );
        $brochureForm->mapValues();
        
        // Check the assigned values are correct
        $this->assertEquals(
            '1 anywhere road', 
            $brochureForm->getElementBy('getName', 'addr1')->getValue()
        );
        $this->assertEquals(
            '1 anywhere road', 
            $brochureForm->getFormValue('addr1')
        );
        $this->assertFalse($brochureForm->getFormValue('falseindex'));
        
        // Check checkbox has been ticked
        $this->assertTrue(
            $brochureForm->getElementBy('getName', 'emailoptin')->isChecked()
        );
    }
    
    /**
     * Test the form callback function
     * 
     * @return void
     */
    public function testValidationCallback()
    {
        $brochureForm = \aw\formfields\forms\BrochureForm::factory(
            array(), 
            array(), 
            array(
                'Select' => '',
                'United Kingdom' => 'GB'
            )
        );
        
        $errors = '';
        $brochureForm->mapValues()->setCallback(
            function($form, $ele, $e) use (&$errors) {
                $errors .= $ele->getName() . ' - ' . $e->getMessage() . '<br>';
            }
        )->validate();
        
        $this->assertEquals(
            'title - Required<br>surname - Required<br>email - Invalid email address<br>telephone - Required<br>addr1 - Required<br>town - Required<br>county - Required<br>postcode - Required<br>other - Required<br>',
            $errors
        );
        
        $this->assertEquals(
            'Error!',
            $brochureForm->mapValues()->setCallback(
                function($form, $ele, $e) {
                    $form->setTemplate('Error!');
                }
            )->validate()->render()
        );
    }
    
    /**
     * Validation method
     * 
     * @param array   $fields Form field values
     * @param integer $result Number of validation errors returned
     * 
     * @dataProvider validationProvider
     */
    public function testValidation($fields, $result)
    {
        $brochureForm = \aw\formfields\forms\BrochureForm::factory(
            array(), 
            $fields, 
            array(
                'Select' => '',
                'United Kingdom' => 'GB'
            )
        );
        $brochureForm->mapValues();
        
        $this->assertEquals(
            $result, 
            count($brochureForm->validate()->getErrors())
        );
        
        $this->assertFalse(
            $brochureForm->isValid()
        );
        
        
    }
    
    /**
     * Validation data provider
     * 
     * @return array
     */
    public function validationProvider()
    {
        return array(
            array(
                array(),
                9
            ),
            array(
                array(
                    'addr1' => '1 anywhere road',
                    'town' => 'Somehwere',
                    'county' => 'In the middle',
                    'postcode' => 'OFN0WRE',
                    'emailoptin' => 'on'
                ),
                5
            ),
            array(
                array(
                    'email' => 'invalid email address',
                    'town' => 'Somehwere'
                ),
                8
            )
        );
    }
}