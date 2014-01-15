<?php

/**
 * Fieldset Helper class. 
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
 * Fieldset Helper class. 
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
class Fieldset extends \aw\formfields\fields\ParentElement
{
    /**
     * Factory method for easy creation
     * 
     * @param string $legend     The legend of the fieldset
     * @param array  $attributes Any attributes to be added
     * @param array  $children   Any child elements of the fieldset
     * 
     * @return \aw\formfields\fields\Fieldset
     */
    public static function factory(
        $legend = '', 
        $attributes = array(), 
        $children = array()
    ) {
        $legend = new \aw\formfields\fields\legend($legend);
        $children = array_unshift($legend, $children);
        $fs = new \aw\formfields\fields\Fieldset(
            $attributes
        );
        return $fs->addChildren($children);
    }

    /**
     * Constructor
     * 
     * @param array $attributes Fieldset attributes
     * 
     * @return void
     */
    public function __construct(
        $attributes = array()
    ) { 
        parent::__construct($attributes);
        $this->setTemplate(
            '<fieldset{implodeAttributes}>{renderChildren}</fieldset>'
        );
    }
}