<?php

/**
 * Checkbox object
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
 * Checkbox object
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
class Checkbox extends \aw\formfields\fields\TextInput
{
    /**
     * Checked state
     * 
     * @var boolean
     */
    protected $checked = false;
    
    /**
     * Set the new checked state
     * 
     * @param boolean $checked Checked state
     * 
     * @return void
     */
    public function setChecked($checked)
    {
        if (is_bool($checked)) {
            $this->checked = $checked;
            
            if ($this->getRule()) {
                $this->getRule()->setValue($checked);
            }
        }
        return $this;
    }
    
    /**
     * Return the checked state
     * 
     * @return boolean
     */
    public function isChecked()
    {
        return $this->checked;
    }
    
    /**
     * Return attributes string, overriden from textfield to include 
     * the checked state. 
     * 
     * @return string
     */
    public function implodeAttributes()
    {
        $attrs = parent::implodeAttributes();
        
        if ($this->isChecked()) {
            $attrs .= ' checked';
        }
        
        return $attrs;
    }
}