<?php

/**
 * Field Helper class. Provides static methods to build html input elements that
 * have data memory
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
 * Textarea object
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
class Textarea extends \aw\formfields\fields\TextField
{
    /**
     * Constructor
     * 
     * @param string $name       Field name
     * @param array  $attributes Field attributes
     * 
     * @return aw\forms\fields\TextField
     */
    public function __construct($name, $attributes = array())
    {
        parent::__construct($name, $attributes);
                
        // Set Template
        $this->setTemplate(
            '<textarea{implodeAttributes}>{getValue}</textarea>'
        );
    }
    
    /**
     * Overloaded attribute implode.  This will implode all attributes 
     * apart from the value attribute.
     * 
     * @param array $ovAttrs Override object attributes so function can be used
     * as a helper function.
     * 
     * @return string
     */
    public function implodeAttributes($ovAttrs = null)
    {
        $attrs = '';
        $attributes = (is_array($ovAttrs) ? $ovAttrs : $this->getAttributes());
        foreach ($attributes as $key => $val) {
            if ($key != 'value') {
                $attrs .= $this->_renderAttribute($key, $val);
            }
        }
        return $attrs;
    }
    
    // -------------------------- Private Methods -------------------------- //
    
    /**
     * Return a key=val string
     * 
     * @param string $key Key of value
     * @param string $val Attribute value
     * 
     * @return string 
     */
    private function _renderAttribute($key, $val)
    {
        return sprintf(
            ' %s="%s"',
            $key,
            $val
        );
    }
}