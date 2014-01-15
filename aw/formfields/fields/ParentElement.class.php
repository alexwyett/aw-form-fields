<?php

/**
 * Base element which allows child elements
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
 * Element object
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
abstract class ParentElement extends \aw\formfields\fields\Element
{
    /**
     * Children
     * 
     * @var array
     */
    protected $children = array();
    
    // ------------------------- Public Methods ---------------------------- //

    /**
     * Add a child to the element
     * 
     * @param object $child Elements child
     * 
     * @return aw\forms\fields\Element
     */
    public function addChild($child)
    {
        $this->children[] = $child;
        return $this;
    }

    /**
     * Adds children to the element
     * 
     * @param array $children An array of child objects
     * 
     * @return aw\forms\fields\Element
     */
    public function addChildren($children)
    {
        $this->children = array_merge($this->getChildren(), $children);
        return $this;
    }

    /**
     * Render object children
     * 
     * @return string
     */
    public function renderChildren()
    {
        $children = $this->getChildren();
        if (count($children) > 0) {
            return $this->_renderChildren($children, '');
        }
        return '';
    }
    
    // ------------------------- Accessor Methods -------------------------- //

    /**
     * Return the element children
     * 
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Return true if element has children
     * 
     * @return boolean
     */
    public function hasChildren()
    {
        return (count($this->getChildren) > 0);
    }
    
    // -------------------------- Private Methods -------------------------- //

    /**
     * Add a child to the element
     * 
     * @param array  $children Elements child
     * @param string $output   Children output
     * 
     * @return void
     */
    private function _renderChildren(
        $children = array(), 
        $output = ''
    ) {
        if (count($children) > 0) {
            $child = array_shift($children);
            $output .= (string) $child;
            return $this->_renderChildren($children, $output);
        }
        return $output;
    }
}