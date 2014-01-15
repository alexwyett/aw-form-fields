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
 * Legend object
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
class Legend extends \aw\formfields\fields\Element
{
    /**
     * Legend text
     * 
     * @var string
     */
    protected $legend = '';    

    /**
     * Constructor
     * 
     * @param string $legend     Legend Text
     * @param array  $attributes Field attributes
     * 
     * @return void
     */
    public function __construct($legend, $attributes = array())
    {
        parent::__construct($attributes);
        $this->setLegend($label);
        
        // Set the template
        $this->setTemplate(
            '<legend{implodeAttributes}>{getLegend}</legend>'
        );
    }
    
    /**
     * Set the Legend
     * 
     * @param string $legend Legend text
     * 
     * @return aw\forms\fields\Legend
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;
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