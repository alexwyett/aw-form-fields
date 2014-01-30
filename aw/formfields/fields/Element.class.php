<?php

/**
 * Base element
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
abstract class Element
{
    /**
     * Id of element
     * 
     * @var string
     */
    protected $id;

    /**
     * Name of element
     * 
     * @var string
     */
    protected $name;
    
    /**
     * Class of element
     * 
     * @var string
     */
    protected $class = '';

    /**
     * Key/value pair array of element attributes
     * 
     * @var array
     */
    protected $attributes = array();
    
    /**
     * Element template
     * 
     * @var string
     */
    protected $template = '{getType}';

    /**
     * Validation rule applied
     * 
     * @var object
     */
    protected $rule = null;
    
    /**
     * Parent object
     * 
     * @var object reference
     */
    protected $parent = null;


    // ------------------------- Public Methods ---------------------------- //
        
    /**
     * Constructor
     * 
     * @param array $attributes Field attributes
     * 
     * @return aw\forms\fields\Element
     */
    public function __construct($attributes = array())
    {
        // Add attributes
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    /**
     * Append another Class
     * 
     * @param string $class Element Class
     * 
     * @return aw\forms\fields\Element
     */
    public function addClass($class)
    {
        return $this->setClass($this->getClass() . ' ' . $class);
    }
    
    /**
     * Append markup to the existing template
     * 
     * @param string $template Template string
     * 
     * @return \aw\formfields\fields\Element
     */
    public function appendTemplate($template)
    {
        return $this->setTemplate($this->getTemplate() . $template);
    }
        
    /**
     * Remove a field attribute
     * 
     * @param string $key Attribute key
     * 
     * @return void
     */
    public function popAttribute($key)
    {
        if (isset($this->attributes[$key])) {
            unset($this->attributes[$key]);

            // Remove property if that exists
            if (property_exists($this, $key)) {
                $this->$key = null;
            }
        }
    }
    
    /**
     * Prepend markup to the existing template
     * 
     * @param string $template Template string
     * 
     * @return \aw\formfields\fields\Element
     */
    public function prependTemplate($template)
    {
        return $this->setTemplate($template . $this->getTemplate());
    }
    
    /**
     * Implode the current element attributes into a string
     * 
     * @return string
     */
    public function implodeAttributes()
    {
        $attrs = '';
        foreach ($this->getAttributes() as $key => $val) {
            $attrs .= $this->_renderAttribute($key, $val);
        }
        return $attrs;
    }  
   
    /**
     * Function used to overwrite a string with the output of any 
     * accessor methods
     *
     * @param string   $template Template pattern
     * @param stdClass $object   Object
     * 
     * @return string
     */
    public function replaceObjectData($template, $object)
    {
        preg_match_all('#\{[^}]*\}#s', $template, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            if (isset($match[0])) {
                $method = str_replace('}', '', str_replace('{', '', $match[0]));
                if (method_exists($object, $method)) {
                    $template = str_replace(
                        '{'.$method.'}', 
                        $object->$method(),
                        $template
                    );
                }
            }
        }
        
        return $template;
    }
    
    /**
     * Rendering function
     * 
     * @return string
     */
    public function render()
    {
        return $this->replaceObjectData($this->getTemplate(), $this);
    }
    
    /**
     * Render element
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
    
    // ------------------------- Accessor Methods -------------------------- //

    /**
     * Add an attribute to the array
     * 
     * @param array $key   Attribute name
     * @param array $value and value
     * 
     * @return void
     */
    public function setAttribute($key, $value)
    {
        // Check to see if a property with that attribute
        // name exists first and set its value too.
        if (property_exists($this, $key)) {
            $this->$key = $value;
        }

        // Set attribute value
        $this->attributes[$key] = $value;
        return $this;
    }
    
    /**
     * Set the Class
     * 
     * @param string $class Element Class
     * 
     * @return aw\forms\fields\TextField
     */
    public function setClass($class)
    {
        $this->class = $class;

        // Set attribute value
        $this->attributes['class'] = $this->getClass();

        return $this;
    }

    /**
     * Set the Id
     * 
     * @param string $id Element ID
     * 
     * @return aw\forms\fields\TextField
     */
    public function setId($id)
    {
        $this->id = $id;

        // Set attribute value
        $this->attributes['id'] = $this->getId();

        return $this;
    }
    
    /**
     * Set the Name
     * 
     * @param string $name Element Name
     * 
     * @return aw\forms\fields\TextField
     */
    public function setName($name)
    {
        $this->name = $name;

        // Set attribute value
        $this->attributes['name'] = $this->getName();

        return $this;
    }
    
    /**
     * Set a parent element reference
     * 
     * @param object &$parent Parent objects reference
     * 
     * @return \aw\formfields\fields\Element
     */
    public function setParent(\aw\formfields\fields\Element &$parent)
    {
        $this->parent = $parent;
        return $this;
    }
    
    /**
     * Set the template
     * 
     * @param string $template Element template
     * 
     * @return void
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    
    /**
     * Set validity status
     *
     * @param string $rule Name of validation rule to use
     * 
     * @return aw\forms\fields\Element
     */
    public function setRule($rule)
    {
        $rule = "\aw\\formfields\\validation\\{$rule}";
        $this->rule = $rule::factory($this->getValue());
        return $this;
    }
    
    /**
     * Retrieve attributes
     * 
     * @return void
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    /**
     * Get the element class
     * 
     * @return string
     */
    public function getClass()
    {
        return trim($this->class);
    }
    
    /**
     * Get the element id
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return the name of the element
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Return a parent object
     * 
     * @return \aw\formfields\fields\Element
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * Get the validation rule
     * 
     * @return \aw\formfields\validation\Valid
     */
    public function getRule()
    {
        return $this->rule;
    }
    
    /**
     * Return the element template
     * 
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
    
    /**
     * Get the field type
     * 
     * @return string
     */
    public function getType()
    {
        $type = strtolower(get_called_class());
        $keywords = array(
            __NAMESPACE__ . '\\',
            'field',
            'button'
        );
        foreach ($keywords as $keyword) {
            $type = str_replace($keyword, '', $type);
        }
        return $type;
    }
    
    // ------------------------ Validation functions ------------------------ //
      
    /**
     * Return true if validation can applied to this element
     * 
     * @return boolean
     */
    public function isTestable()
    {
        return is_object($this->getRule());
    }
    
    /**
     * Test required status
     *
     * @return boolean
     */
    public function isRequired()
    {
        if ($this->isTestable()) {
            return $this->getRule()->isRequired();
        } else {
            return false;
        }
    }
    
    // -------------------------- Private Methods -------------------------- //
    
    /**
     * Return a key=val string
     * 
     * @param string $key Key of value
     * @param string $val Attribute value
     * 
     * @return string 
     */
    private function _renderAttribute($key, $val)
    {
        return sprintf(
            ' %s="%s"',
            $key,
            $val
        );
    }
}