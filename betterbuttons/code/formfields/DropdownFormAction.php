<?php

/**
 * Defines the button that holds several form actions and exposes them on click
 *
 * @author  Uncle Cheese <unclecheese@leftandmain.com>
 * @package  silverstripe-gridfield-betterbuttons
 */
class DropdownFormAction extends CompositeField implements BetterButtonInterface {

	
	/**
	 * To ensure the buttons get unique ids, keep track of the instances
	 * @var integer
	 */
	protected static $instance_count = 0;	


	/**
	 * A unique identifier assigned through $instance_count
	 * @var string
	 */
	protected $identifier;


	/**
	 * Builds the button
	 * @param string $title    The text for the button
	 * @param array  $children Child buttons (FormActions)
	 */
	public function __construct($title = null, $children = array ()) {
		$this->Title = $title;
		foreach($children as $c) {
			$c->setUseButtonTag(true);
		}
		parent::__construct($children);		
		self::$instance_count++;
		$this->identifier = self::$instance_count;
	}


	/**
	 * Renders the button, includes the JS and CSS
	 * @param array $properties
	 */
	public function Field($properties = array ()) {		
		Requirements::css(BETTER_BUTTONS_DIR.'/css/dropdown_form_action.css');
		Requirements::javascript(BETTER_BUTTONS_DIR.'/javascript/dropdown_form_action.js');
		$this->setAttribute('data-form-action-dropdown','#'.$this->DropdownID());

		return parent::Field();
	}


	/**
	 * A unique id for the dropdown button
	 *
	 * @return  string
	 */
	public function DropdownID() {
		return 'form-action-dropdown-'.$this->identifier;
	}


	/**
	 * Determines if the button should displsy
	 * @return boolean
	 */
	public function shouldDisplay() {		
		foreach($this->children as $child) {
			if($child->shouldDisplay()) {
				return true;
			}
		}

		return false;
	}


	/**
	 * Binds to the GridField request, and transforms the buttons
	 * @param Form $form
	 * @param GridFieldDetailForm_ItemRequest $request
	 */
	public function bindGridField(Form $form, GridFieldDetailForm_ItemRequest $request) {
		$this->setForm($form);
		$this->gridFieldRequest = $request;

		foreach($this->children as $child) {
			if(!$child instanceof BetterButton) {
				throw new Exception("DropdownFormAction must be passed instances of BetterButton");
			}
			$child->bindGridField($form, $request);
			$child->setIsGrouped(true);			
			$child->setUseButtonTag(true);
		}

		return $this;
	}

}