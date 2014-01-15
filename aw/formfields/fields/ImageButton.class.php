<?php

/**
 * Image button class
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
 * Image button object
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
class Image extends \aw\formfields\fields\ValueElement
{
    /**
     * Constructor
     * 
     * @param string $name       Field name
     * @param array  $attributes Field attributes
     * 
     * @return aw\forms\fields\TextField
     */
    public function __construct($attributes = array())
    {
        // Add attributes
        parent::__construct($attributes);
        
        // Set the template
        $this->setTemplate(
            '<input type="image" {implodeAttributes}>'
        );
    }
}