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
 * Label object
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
class Label extends \aw\formfields\fields\ParentElement
{
    /**
     * Label text
     * 
     * @var string
     */
    protected $label = '';    

    /**
     * Constructor
     * 
     * @param string $label      Label Text
     * @param array  $attributes Field attributes
     * 
     * @return void
     */
    public function __construct($label, $attributes = array())
    {
        parent::__construct($attributes);
        $this->setLabel($label);
        
        // Set the template
        $this->setTemplate(
            '<label{implodeAttributes}>{getLabel}{renderChildren}</label>'
        );
    }
    
    /**
     * Set the label
     * 
     * @param string $label Label text
     * 
     * @return aw\forms\fields\Label
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
    
    /**
     * Return label text
     * 
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}