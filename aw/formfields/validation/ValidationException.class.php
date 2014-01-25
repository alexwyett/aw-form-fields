<?php

/**
 * Form validation Exception object.
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
 * Form validation Exception object.
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
class ValidationException extends \RuntimeException
{    
    /**
     * Custom string representation of object
     * 
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '%s: [%s]: %s',
            __CLASS__,
            $this->getCode(),
            $this->getMessage()
        );
    }
}
