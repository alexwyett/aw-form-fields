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
 * Optgroup object
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
class Optgroup extends \aw\formfields\fields\Label
{
    /**
     * Factory method for creating an option group box
     * 
     * @param string $label       Optgroup label
     * @param array  $values      Values of the optgroup options in key/val pair
     * @param array  $attributes  Element attributes
     * 
     * @return \aw\formfields\fields\Optgroup
     */
    public static function factory(
        $label, 
        $values = array(),
        $attributes = array()
    ) {
        $optgroup = new \aw\formfields\fields\Optgroup($label, $attributes);
        foreach ($values as $key => $val) {
            if (is_array($val) && isset($val['value'])) {
                $op = new \aw\formfields\fields\Option(
                    $key,
                    $val['value'],
                    $val      
                );
            } else {
                $op = new \aw\formfields\fields\Option(
                    $key,
                    $val      
                );
            }
            $optgroup->addChild($op);
        }

        return $optgroup;
    }
    
    /**
     * Constructor
     * 
     * @param string $label      Label Text
     * @param array  $attributes Optgroup attributes
     * 
     * @return void
     */
    public function __construct($label, $attributes = array())
    {
        parent::__construct($label, $attributes);
        
        // Set the template
        $this->setTemplate(
            '<optgroup label="{getLabel}"{implodeAttributes}>{renderChildren}</optgroup>'
        );
    }
}