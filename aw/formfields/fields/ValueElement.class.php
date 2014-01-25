<?php

/**
 * Base element with a value
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

namespace aw\formfields\fields;

/**
 * Value element
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
abstract class ValueElement extends \aw\formfields\fields\Element
{
    /**
     * Value of element
     * 
     * @var string
     */
    protected $value = null;
    
    // ------------------------- Accessor Methods -------------------------- //
    
    /**
     * Set the Value
     * 
     * @param string $value Element Value
     * 
     * @return aw\forms\fields\TextField
     */
    public function setValue($value)
    {
        $this->value = $value;

        // Set attribute value
        $this->attributes['value'] = $this->getValue();

        // Set value to validation rule if present
        if ($this->getRule()) {
            $this->getRule()->setValue($this->getValue());
        }

        return $this;
    }
    
    /**
     * Get the element value
     * 
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}