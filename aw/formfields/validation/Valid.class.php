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
    
    // ------------------------ Constructor --------------------------------- //

    /**
     * Factory method
     * 
     * @param boolean $required Required bool
     * 
     * @return \aw\formfields\validation\Valid
     */
    public static function factory($required = false)
    {
        $rule = new \aw\formfields\validation\Valid();
        $rule->setRequired($required);
        return $rule;
    }
    
    // ------------------------ Accessor functions -------------------------- //

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
     * @param mixed $value Value to test
     * 
     * @return boolean
     */
    public function validate($value)
    {
        return !is_null($value);
    }
    
    /**
     * String min length check
     * 
     * @param mixed   $value  Value to test
     * @param integer $length Min Length to check
     * 
     * @return boolean
     */
    public function validateLengthGreaterThan($value, $length = 0)
    {
        if ($this->validate($value)) {
            return strlen((string) $value) > $length;
        }
        return false;
    }
}