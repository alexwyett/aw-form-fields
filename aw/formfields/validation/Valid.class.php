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
        $rule = new \aw\formfields\validation\Valid();
        $rule->setValue($value)
            ->setRequired($required);
        return $rule;
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
     * Validation function at the base level
     * 
     * @return boolean
     */
    public function validateNull()
    {
        return !is_null($this->getValue());
    }
    
    /**
     * String min length check
     * 
     * @param integer $min Min Length to check
     * @param integer $max Max Length to check
     * 
     * @return boolean
     */
    public function validateString($min = 1, $max = 0)
    {
        if ($this->validateNull()) {
            if ($min >= $max) {
                return strlen((string) $this->getValue()) >= $min;
            } else {
                return strlen((string) $this->getValue()) >= $min
                    && strlen((string) $this->getValue()) <= $max;
            }
        }
        return false;
    }
}