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
 * Option object
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
class Option extends \aw\formfields\fields\ValueElement
{
    /**
     * Option display value
     * 
     * @var string
     */
    protected $display = '';
    
    /**
     * Option selected state
     * 
     * @var boolean
     */
    protected $selected = false;    

    /**
     * Constructor
     * 
     * @param string $display    Option display value
     * @param string $value      Option value
     * @param array  $attributes Option attributes
     * 
     * @return void
     */
    public function __construct($display, $value, $attributes = array())
    {
        // Add attributes
        parent::__construct($attributes);

        // Set display value
        $this->setDisplayValue($display);

        // Set value of option
        $this->setValue($value);
        
        // Set the template
        $this->setTemplate(
            '<option{implodeAttributes}>{getDisplayValue}</option>'
        );
    }
    
    // ------------------------- Accessor Methods -------------------------- //
    
    /**
     * Get the selected state
     * 
     * @return boolean
     */
    public function isSelected()
    {
        return $this->selected;
    }
    
    /**
     * Set the display text
     * 
     * @param string $display Display text
     * 
     * @return \aw\formfields\fields\Option
     */
    public function setDisplayValue($display)
    {
        $this->display = $display;
        return $this;
    }
    
    /**
     * Set the selected state
     * 
     * @param boolean $selected Selected bool
     * 
     * @return \aw\formfields\fields\Option
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        if ($this->isSelected()) {
            $this->attributes['selected'] = 'selected';
        } else {
            unset($this->attributes['selected']);
        }

        return $this;
    }
    
    /**
     * Return display text
     * 
     * @return string
     */
    public function getDisplayValue()
    {
        return $this->display;
    }
}