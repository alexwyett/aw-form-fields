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
class ValidEmail extends \aw\formfields\validation\ValidString
{    
    // ------------------------ Validation functions ------------------------ //

    /**
     * Email Validation function
     * 
     * @return boolean
     */
    public function validateEmail()
    {
        if (!filter_var($this->getValue(), FILTER_VALIDATE_EMAIL)) {
            throw new \aw\formfields\validation\ValidationException(
                'Invalid email address',
                1002
            );
        }
    }
}