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
class ImageButton extends \aw\formfields\fields\ValueElement
{
    /**
     * Image src
     * 
     * @var string
     */
    protected $src = '';
    
    /**
     * Constructor
     * 
     * @param string $src        Image source
     * @param array  $attributes Field attributes
     * 
     * @return void
     */
    public function __construct($src, $attributes = array())
    {
        // Set the source
        $this->setSrc($src);
        
        // Add attributes
        parent::__construct($attributes);
        
        // Set the template
        $this->setTemplate(
            '<input type="image"{implodeAttributes}>'
        );
    }
    
    // ------------------------- Accessor Methods -------------------------- //
    
    /**
     * Return the image button source
     * 
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }
    
    /**
     * Set the source
     * 
     * @param string $src Image source
     * 
     * @return aw\forms\fields\ImageButton
     */
    public function setSrc($src)
    {
        $this->src = $src;

        // Set attribute value
        $this->attributes['src'] = $this->getSrc();

        return $this;
    }
}