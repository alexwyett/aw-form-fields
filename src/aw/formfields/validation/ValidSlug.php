<?php

/**
 * Slug Validation rules for form fields
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
 * Slug Validation object
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
class ValidSlug extends \aw\formfields\validation\ValidString
{
    /**
     * String validation
     * 
     * @return boolean
     */
    public function validateSlug()
    {
        if (!preg_match('/[a-z0-9]*$/', $this->getValue())) {
            // @codeCoverageIgnoreStart
            // TODO: Why does this not get covered in the unit tests?
            throw new \aw\formfields\validation\ValidationException(
                'Alpha/Numeric characters only',
                1005
            );
            // @codeCoverageIgnoreEnd
        }
        
        return true;
    }
}