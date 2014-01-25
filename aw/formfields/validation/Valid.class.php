<?php

/**
 * Validation rules for form form fields
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

namespace aw\formfields\validation;

/**
 * Validation object
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
class Valid
{
    /**
     * Required boolean
     * 
     * @var boolean
     */
    protected $required = false;

    /**
     * Value to test
     * 
     * @var mixed
     */
    protected $value;
    
    // ------------------------ Constructor --------------------------------- //

    /**
     * Factory method
     * 
     * @param mixed   $value    Testing value
     * @param boolean $required Required bool
     * 
     * @return \aw\formfields\validation\Valid
     */
    public static function factory($value, $required = false)
    {
        $class = self::getType();
        $rule = new $class();
        $rule->setValue($value)
            ->setRequired($required);
        return $rule;
    }

    
    /**
     * Get the class name from the instantitated class
     * 
     * @return string
     */
    public static function getType()
    {
        return get_called_class();
    }
    
    // ------------------------ Accessor functions -------------------------- //
    
    /**
     * Return the test value
     * 
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Required boolean check
     * 
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * Set the test value
     * 
     * @param mixed $value Value to test
     * 
     * @return \aw\formfields\validation\Valid
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Toogle the required flag
     * 
     * @param boolean $required Required boolean
     * 
     * @return \aw\formfields\validation\Valid
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }
    
    // ------------------------ Validation functions ------------------------ //

    /**
     * Validation method
     * 
     * @return boolean
     */
    public function validate()
    {
        foreach (get_class_methods($this) as $method) {
            if (substr($method, 0, 8) ==  'validate'
                && $method != 'validate'
            ) {
                if (!$this->$method()) {
                    return false;
                }
            }
        }
        
        return true;
    }
    
    /**
     * Validation function at the base level
     * 
     * @return boolean
     */
    public function validateNull()
    {
        if (is_null($this->getValue())) {
            throw new \aw\formfields\validation\ValidationException(
                'Required', 
                1000
            );
        }
        
        return true;
    }
    
    /**
     * String validation
     * 
     * @return boolean
     */
    public function validateString()
    {
        if ($this->validateNull() && is_string($this->getValue())) {
            if (strlen($this->getValue()) == 0) {
                throw new \aw\formfields\validation\ValidationException(
                    'Required',
                    1000
                );
            }
        }
        
        return true;
    }
}