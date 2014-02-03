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
     * @param aw\forms\fields\Element $child Elements child
     * 
     * @return aw\forms\fields\Element
     */
    public function addChild($child)
    {
        $child->setParent($this);
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
        foreach ($children as $child) {
            $this->addChild($child);
        }
        return $this;
    }
    
    /**
     * Loop function to apply a callback to a particular accessor pattern
     * 
     * @param string   $accessor Accessor method to call
     * @param string   $value    Comparison value
     * @param function $callback Callback function to apply
     * 
     * @return void
     */
    public function each($accessor, $value, $callback = null)
    {
        foreach ($this->getElementsBy($accessor, $value) as $ele) {
            if (is_callable($callback)) {
                $callback($ele);
            }
        }
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
     * Return a child object from the parent
     * 
     * @param integer $index Index of child
     * 
     * @return mixed
     */
    public function getChild($index)
    {
        return $this->children[$index];
    }
    
    /**
     * Return a child object or objects from the parent
     * 
     * @param string $accessor Accessor method to call
     * @param string $value    Comparison value
     * 
     * @return array
     */
    public function getElementsBy($accessor, $value)
    {
        $elements = $this->getElementBy($accessor, $value);
        if (!is_array($elements)) {
            $elements = array($elements);
        }
        return $elements;
    }
    
    /**
     * Return a child object or objects from the parent
     * 
     * @param string  $accessor Accessor method to call
     * @param string  $value    Comparison value
     * @param integer $index    Index of array to return if you're sure the
     * method will return an array!
     * 
     * @return \aw\formfields\fields\Element|Array
     */
    public function getElementBy($accessor, $value, $index = null)
    {
        $objects = array();
        self::traverseChildren(
            $this, 
            function ($ele) use ($accessor, $value, &$objects) {
                if (method_exists($ele, $accessor)) {
                    if ($value === $ele->$accessor()) {
                        array_push($objects, $ele);
                    }
                }
            }
        );
        
        // Set index to be the first element if there is only one
        // element in the array
        if (count($objects) == 1) {
            $index = 0;
        }
        
        if (is_numeric($index) && isset($objects[$index])) {
            return $objects[$index];
        } else {
            return $objects;
        }
    }

    /**
     * Return true if element has children
     * 
     * @return boolean
     */
    public function hasChildren()
    {
        return (count($this->getChildren()) > 0);
    }
    
    // -------------------------- Helper Methods -------------------------- //

    /**
     * Child traversal function
     * 
     * @param object   $object   Object to traverse
     * @param function $callback Callback function to apply to child object
     * 
     * @return void
     */
    public static function traverseChildren($object, $callback)
    {
        call_user_func($callback, $object);
        if (method_exists($object, 'hasChildren')) {
            foreach ($object->getChildren() as $child) {
                self::traverseChildren($child, $callback);
            }
        }
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