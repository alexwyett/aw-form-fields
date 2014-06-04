<?php

/**
 * Original Cottages Advanced Search form object
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
 * Original Cottages Advanced Search form object.  Extends the generic form and 
 * provides a static helper method to build the form object
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
class ToccAdvancedSearch extends \aw\formfields\forms\StaticForm
{
    /**
     * Area select field
     * 
     * @var \aw\formfields\fields\Label
     */
    protected $areaSelect;
    
    /**
     * Location select field
     * 
     * @var \aw\formfields\fields\Label
     */
    protected $locationSelect;
    
    /**
     * Distances used to filter locations
     * 
     * @var array
     */
    protected $distances = array(
        'Distance from' => 0,
        'Within 1 mile' => 1.6,
        'Within 3 miles' => 4.8,
        'Within 5 miles' => 8,
        'Within 10 miles' => 16,
        'Within 15 miles' => 24,
        'Within 20 miles' => 32
    );
    
    /**
     * Nights dropdown values
     * 
     * @var array
     */
    protected $nights = array(
        '2 nights' => 2,
        '3 nights' => 3,
        '4 nights' => 4,
        '5 nights' => 5,
        '6 nights' => 6,
        '7 nights' => array(
            'value' => 7,
            'selected' => 'selected'
        ),
        '8 nights' => 8,
        '9 nights' => 9,
        '10 nights' => 10,
        '11 nights' => 11,
        '12 nights' => 12,
        '13 nights' => 13,
        '14 nights' => 14,
        '15 nights' => 15,
        '16 nights' => 16,
        '17 nights' => 17,
        '18 nights' => 18,
        '19 nights' => 19,
        '20 nights' => 20,
        '21 nights' => 21,
        '22 nights' => 22,
        '23 nights' => 23,
        '24 nights' => 24,
        '25 nights' => 25,
        '26 nights' => 26,
        '27 nights' => 27,
        '28 nights' => 28,
    );
    
    /**
     * Sleeps dropdown values
     * 
     * @var array
     */
    protected $sleeps = array(
        'Number of people (excl. infants under 2yrs)' => '',
        '1' => '>1',
        '2' => '>2',
        '3' => '>3',
        '4' => '>4',
        '5' => '>5',
        '6' => '>6',
        '7' => '>7',
        '8' => '>8',
        '9' => '>9',
        '10+' => '>10'
    );
    
    /**
     * Bedrooms dropdown values
     * 
     * @var array
     */
    protected $bedrooms = array(
        'Any' => '',
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5+' => '>5'
    );
    
    /**
     * Stars dropdown values
     * 
     * @var array
     */
    protected $stars = array(
        'Any' => '',
        '2' => '>2',
        '3' => '>3',
        '4' => '>4',
        '5' => '5'
    );
    
    /**
     * Bathooms dropdown values
     * 
     * @var array
     */
    protected $bathrooms = array(
        'Any' => '',
        '1' => '>1',
        '2' => '>2',
        '3' => '>3'
    );
    
    /**
     * Dogs dropdown values
     * 
     * @var array
     */
    protected $dogs = array(
        'Any' => '',
        '1' => '>1',
        '2' => '>2',
        '3' => '>3'
    );
    
    /**
     * Array of attribute objects
     * 
     * @var array
     */
    protected $searchAttributes = array();


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
        parent::__construct($attributes, $formValues);
        
        // Add Fieldset
        $this->addChildren(
            array(
                \aw\formfields\fields\Fieldset::factory(
                    'Where would you like to go?',
                    array(
                        'id' => 'fs1'
                    )
                ),
                \aw\formfields\fields\Fieldset::factory(
                    'Refine your search...',
                    array(
                        'id' => 'fs2'
                    )
                ),
                \aw\formfields\fields\Fieldset::factory(
                    'Additional options...',
                    array(
                        'id' => 'fs3'
                    )
                )
            )
        );
        
        
        // Add submit button
        $this->addChild(
            new \aw\formfields\fields\SubmitButton(
                array(
                    'value' => 'View Cottages',
                    'class' => 'view-cottages submit'
                )
            )
        );
    }
    
    /**
     * Build function - creates the advanced search form
     * 
     * @return \ToccAdvancedSearch
     */
    public function build()
    {
        // Add in the area select box if needed and is set
        if ($this->getAreaSelect()) {
            $this->getElementBy('getId', 'fs1')
                ->addChild(
                    $this->getAreaSelect()
                );
        }
        
        // Add in location select box if required
        if ($this->getLocationSelect()) {
            if ($this->getAreaSelect()) {
                // Add in data-target attribute to area field
                $this->getElementBy(
                    'getId', 
                    $this->getAreaSelect()->getChild(0)->getId()
                )->setAttribute(
                    'data-target-id', 
                    '#' . $this->getLocationSelect()->getChild(0)->getId()
                );
            }
            
            $this->getElementBy('getId', 'fs1')
                ->addChild(
                    $this->getLocationSelect()
                );
            
        
            // Add in distance dropdown
            if ($this->getDistances()) {
                $this->getElementBy('getId', 'fs1')
                    ->addChild(
                        $this->createBasicSelect(
                            'Distance from', 
                            $this->getDistances(), 
                            'distance', 
                            'distance'
                        )
                    );
            }
        }
        
        // Add in arrival date
        $this->getElementBy('getId', 'fs1')
            ->addChild(
                \aw\formfields\forms\StaticForm::getNewLabelAndTextField(
                    'Arrival Date'
                )->getChild(0)
                    ->setName('fromDate')
                    ->setId('fromDate')
                    ->setAttribute('readonly', 'true')
                    ->setAttribute('placeholder', 'Arrival Date')
                    ->setClass('placeholder datepicker')
                    ->getParent()
                        ->setAttribute('for', 'fromDate')
            );
        
        // Add in number of nights drop down
        if ($this->getNights()) {
            $this->getElementBy('getId', 'fs1')
                ->addChild(
                    $this->createBasicSelect(
                        'Number of nights', 
                        $this->getNights(), 
                        'nights', 
                        'nights'
                    )
                );
        }
        
        // Add in number of people search
        if ($this->getSleeps()) {
            $this->getElementBy('getId', 'fs1')
                ->addChild(
                    $this->createBasicSelect(
                        'Number of people', 
                        $this->getSleeps(), 
                        'accommodates', 
                        'sleeps'
                    )
                );
        }
        
        // Add in number of bedrooms search
        if ($this->getBedrooms()) {
            $this->getElementBy('getId', 'fs2')
                ->addChild(
                    $this->createBasicSelect(
                        'Number of bedrooms', 
                        $this->getBedrooms(), 
                        'bedrooms', 
                        'bedrooms'
                    )
                );
        }
        
        // Add in number of bathrooms search
        if ($this->getBathrooms()) {
            $this->getElementBy('getId', 'fs2')
                ->addChild(
                    $this->createBasicSelect(
                        'Number of bathrooms', 
                        $this->getBathrooms(), 
                        'ATTR63', 
                        'bathrooms'
                    )
                );
        }
        
        // Add in number of dogs search
        if ($this->getDogs()) {
            $this->getElementBy('getId', 'fs2')
                ->addChild(
                    $this->createBasicSelect(
                        'Number of pets', 
                        $this->getDogs(), 
                        'ATTR08', 
                        'dogs'
                    )
                );
        }
        
        // Add in number of stars search
        if ($this->getStars()) {
            $this->getElementBy('getId', 'fs2')
                ->addChild(
                    $this->createBasicSelect(
                        'Star rating', 
                        $this->getStars(), 
                        'rating', 
                        'stars'
                    )
                );
        }
        
        // Add attributes to third fieldset
        if ($this->getSearchAttributes()) {
            $this->getElementBy('getId', 'fs3')
                ->addChildren(
                    $this->getSearchAttributes()
                );
        }
        
        return $this;
    }
    
    /**
     * Set the number of nights
     * 
     * @param array $nights Number of nights array
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setNights($nights)
    {
        $this->nights = $nights;
        
        return $this;
    }
    
    /**
     * Get the number of nights
     * 
     * @return array
     */
    public function getNights()
    {
        return $this->nights;
    }
    
    /**
     * Set the number of sleeps
     * 
     * @param array $sleeps Number of sleeps array
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setSleeps($sleeps)
    {
        $this->sleeps = $sleeps;
        
        return $this;
    }
    
    /**
     * Get the number of sleeps
     * 
     * @return array
     */
    public function getSleeps()
    {
        return $this->sleeps;
    }
    
    /**
     * Set the number of bedrooms
     * 
     * @param array $bedrooms Number of bedrooms array
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setBedrooms($bedrooms)
    {
        $this->bedrooms = $bedrooms;
        
        return $this;
    }
    
    /**
     * Get the number of bedrooms
     * 
     * @return array
     */
    public function getBedrooms()
    {
        return $this->bedrooms;
    }
    
    /**
     * Set the number of stars
     * 
     * @param array $stars Number of stars array
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setStars($stars)
    {
        $this->stars = $stars;
        
        return $this;
    }
    
    /**
     * Get the number of stars
     * 
     * @return array
     */
    public function getStars()
    {
        return $this->stars;
    }
    
    /**
     * Set the number of dogs
     * 
     * @param array $dogs Number of dogs array
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setDogs($dogs)
    {
        $this->dogs = $dogs;
        
        return $this;
    }
    
    /**
     * Get the number of dogs
     * 
     * @return array
     */
    public function getDogs()
    {
        return $this->dogs;
    }
    
    /**
     * Set the number of bathrooms
     * 
     * @param array $bathrooms Number of bathrooms array
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setBathrooms($bathrooms)
    {
        $this->bathrooms = $bathrooms;
        
        return $this;
    }
    
    /**
     * Get the number of bathrooms
     * 
     * @return array
     */
    public function getBathrooms()
    {
        return $this->bathrooms;
    }
    
    /**
     * Set the area label/select box
     * 
     * @param \aw\formfields\fields\Label $areaSelect
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setAreaSelect($areaSelect)
    {
        $this->areaSelect = $areaSelect;
        
        return $this;
    }
    
    /**
     * Get the area label/select box
     * 
     * @return \aw\formfields\fields\Label
     */
    public function getAreaSelect()
    {
        return $this->areaSelect;
    }
    
    /**
     * Set the location label/select box
     * 
     * @param \aw\formfields\fields\Label $locationSelect
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setLocationSelect($locationSelect)
    {
        $this->locationSelect = $locationSelect;
        
        return $this;
    }
    
    /**
     * Get the location label/select box
     * 
     * @return \aw\formfields\fields\Label
     */
    public function getLocationSelect()
    {
        return $this->locationSelect;
    }
    
    /**
     * Set the Distances array
     * 
     * @param array $distances
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setDistances($distances)
    {
        $this->distances = $distances;
        
        return $this;
    }
    
    /**
     * Get the distances array
     * 
     * @return \aw\formfields\fields\Label
     */
    public function getDistances()
    {
        return $this->distances;
    }
    
    /**
     * Create a basic select.  Function created just to save repetition
     * 
     * @param string $label  Label of control
     * @param array  $values Select values
     * @param string $name   Name of select
     * @param string $id     Id of select (also used for the for of the label)
     * 
     * @return \aw\formfields\fields\Label
     */
    public function createBasicSelect($label, $values, $name, $id)
    {
        return \aw\formfields\forms\StaticForm::getNewLabelAndSelect(
            $label, 
            $values
        )->getChild(0)
            ->setName($name)
            ->setId($id)
            ->getParent()
                ->setAttribute('for', $id);
    }
    
    /**
     * Create a attribute checkbox and add to array
     * 
     * @param string $label  Label of control
     * @param string $name   Name of checkbox
     * 
     * @return \aw\formfields\forms\ToccAdvancedSearch
     */
    public function setSearchAttribute($label, $name)
    {
        array_push(
            $this->searchAttributes, 
            \aw\formfields\forms\StaticForm::getNewLabelAndCheckboxField(
                $label
            )->getChild(0)
                ->setName($name)
                ->setId($name)
                ->setValue('true')
                ->getParent()
                    ->setAttribute('for', $name)
        );

        return $this;
    }
    
    /**
     * Get the search form attributes
     * 
     * @return array
     */
    public function getSearchAttributes()
    {
        return $this->searchAttributes;
    }
}
