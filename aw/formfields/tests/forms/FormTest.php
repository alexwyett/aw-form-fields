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

require_once '../../autoload.php';

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
                7
            ),
            array(
                array(
                    'addr1' => '1 anywhere road',
                    'town' => 'Somehwere',
                    'county' => 'In the middle',
                    'postcode' => 'OFN0WRE',
                    'emailoptin' => 'on'
                ),
                3
            ),
            array(
                array(
                    'email' => 'invalid email address',
                    'town' => 'Somehwere'
                ),
                6
            )
        );
    }
}