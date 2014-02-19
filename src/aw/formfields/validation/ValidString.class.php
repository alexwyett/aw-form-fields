<?php

/**
 * String Validation rules for form fields
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
 * String Validation object
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
class ValidString extends \aw\formfields\validation\Valid
{
    /**
     * String validation
     * 
     * @return boolean
     */
    public function validateString()
    {
        if (!is_string($this->getValue()) || strlen($this->getValue()) == 0) {
            throw new \aw\formfields\validation\ValidationException(
                'Required',
                1001
            );
        }
        
        return true;
    }
}