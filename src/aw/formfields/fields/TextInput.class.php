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
 * Textfield object
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
class TextInput extends \aw\formfields\fields\ValueElement
{
    /**
     * Constructor
     * 
     * @param string $name       Field name
     * @param array  $attributes Field attributes
     * 
     * @return void
     */
    public function __construct($name, $attributes = array())
    {
        // Add attributes
        parent::__construct($attributes);

        // Set element name
        $this->setName($name);
        
        // Set the template
        $this->setTemplate(
            '<input type="{getType}"{implodeAttributes}>'
        );
    }
}