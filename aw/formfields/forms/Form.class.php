<?php

/**
 * Form Helper class. Provides static methods to build html forms that
 * have data memory
 *
 * PHP Version 5.3
 *
 * @category  Forms
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */

namespace aw\formfields\forms;

/**
 * Form object
 *
 * PHP Version 5.3
 * 
 * @category  Forms
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */
class Form extends \aw\formfields\fields\ParentElement
{
    /**
     * Boolean flag for a testable element
     * 
     * @var boolean
     */
    protected $testable = false;

    /**
     * Key/value pair array of form values (for peristancy)
     * 
     * @var array
     */
    protected $formValues = array();

    /**
     * Constructor
     * 
     * @param array $attributes Form attributes
     * @param array $formValues Form Values
     * 
     * @return void
     */
    public function __construct(
        $attributes = array(),
        $formValues = array()
    ) {
        parent::__construct($attributes);
        $this->setFormValues($formValues);
        $this->setTemplate(
            '<form{implodeAttributes}>{renderChildren}</form>'
        );
    }
    
    /**
     * Form validate function
     * 
     * @return \aw\formfields\forms\Form
     */
    public function validate()
    {
        $this->validateForm();
        return $this;
    }
    
    /**
     * Form validate function
     * 
     * @return void
     */
    public function validateForm()
    {
        return self::traverseChildren(
            $this,
            function ($ele) {
                if ($ele->isRequired() 
                    && !$ele->getRule()->validateLengthGreaterThan($ele->getValue())
                ) {
                    $ele->addClass('required')
                        ->setTemplate($ele->getTemplate() . '*required');
                }
                return;
            }
        );
    }
    
    // ---------------------- Accessor Methods ----------------------------- //
        
    /**
     * Set form values
     * 
     * @param array $formValues Attribute name
     * 
     * @return \aw\formfields\forms\Form
     */
    public function setFormValues($formValues)
    {
        $this->formValues = $formValues;
    }
    
    /**
     * Retrieve form values
     * 
     * @return array
     */
    public function getFormValues()
    {
        return $this->formValues;
    }
    
    // -------------------------- Helper Methods -------------------------- //

    /**
     * Child traversal function
     * 
     * @param object   $object   Object to traverse
     * @param function $callback Callback function to apply to child object
     * 
     * @return mixed
     */
    public static function traverseChildren($object, $callback)
    {
        if (method_exists($object, 'hasChildren')) {
            foreach ($object->getChildren() as $child) {
                call_user_func($callback, $object);
                return self::traverseChildren($child, $callback);
            }
        } else {
            call_user_func($callback, $object);
            return;
        }
    }

}