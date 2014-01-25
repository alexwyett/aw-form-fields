<?php

/**
 * Form Helper class. Provides static methods to build html forms that
 * have data memory
 *
 * PHP Version 5.3
 *
 * @category  Forms
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */

namespace aw\formfields\forms;

/**
 * Form object
 *
 * PHP Version 5.3
 * 
 * @category  Forms
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */
class Form extends \aw\formfields\fields\ParentElement
{
    /**
     * Key/value pair array of form values (for peristancy)
     * 
     * @var array
     */
    protected $formValues = array();
    
    /**
     * Form validation errors.  This will be a collection of exception objects
     * 
     * @var array
     */
    protected $errors = array();

    /**
     * Constructor
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * 
     * @return void
     */
    public function __construct(
        $attributes = array(),
        $formValues = array()
    ) {
        parent::__construct($attributes);
        $this->setFormValues($formValues);
        $this->setTemplate(
            '<form{implodeAttributes}>{renderChildren}</form>'
        );
    }
    
    /**
     * Form validate function
     * 
     * @return \aw\formfields\forms\Form
     */
    public function validate()
    {
        $this->validateForm();
        return $this;
    }
    
    /**
     * Form validate function
     * 
     * @return void
     */
    public function validateForm()
    {
        $form = $this;
        return self::traverseChildren(
            $this,
            function ($ele) use (&$form) {
                if ($ele->getRule()) {
                    try {
                        $ele->getRule()->validate();
                    } catch (\aw\formfields\validation\ValidationException $e) {
                        $form->setError($ele->getName(), $e->getMessage());
                        $ele->addClass('required')
                            ->setTemplate(
                                $ele->getTemplate() . ' ' . $e->getMessage()
                            );
                    }
                }
                return;
            }
        );
    }
    
    // ---------------------- Accessor Methods ----------------------------- //
        
    /**
     * Set form values
     * 
     * @param array $formValues Attribute name
     * 
     * @return \aw\formfields\forms\Form
     */
    public function setFormValues($formValues)
    {
        $this->formValues = $formValues;
        return $this;
    }
    
    /**
     * Retrieve form values
     * 
     * @return array
     */
    public function getFormValues()
    {
        return $this->formValues;
    }
    
    /**
     * Return a specific form value or false
     * 
     * @param string $key Array key
     * 
     * @return mixed
     */
    public function getFormValue($key)
    {
        $values = $this->getFormValues();
        if (array_key_exists($key, $values)) {
            return $values[$key];
        }
        return false;
    }
    
    /**
     * Set a validation error
     * 
     * @param string $element Element name
     * @param string $error   Error string
     * 
     * @return \aw\formfields\forms\Form
     */
    public function setError($element, $error)
    {
        $this->errors[$element] = $error;
        return $this;
    }
    
    // -------------------------- Helper Methods -------------------------- //
    
    /**
     * Public mapping function. Returns the form object for chainability(?!)
     * 
     * @return \aw\formfields\forms\Form
     */
    public function mapValues()
    {
        $this->_mapValues();
        return $this;
    }
    
    /**
     * Mapping function to set form elements to their form values
     * 
     * @return void
     */
    private function _mapValues()
    {
        $form = $this;
        return self::traverseChildren(
            $this,
            function ($ele) use ($form) {
                if ($ele->getName() 
                    && array_key_exists($ele->getName(), $form->getFormValues())
                ) {
                    if (method_exists($ele, 'setChecked')
                        && ($ele->getValue() == $form->getFormValue($ele->getName())
                        || $form->getFormValue($ele->getName()) == 'on')
                    ) {
                        $ele->setChecked(true);
                    } else {
                        $ele->setValue($form->getFormValue($ele->getName()));
                    }
                }
                return;
            }
        );
    }
}