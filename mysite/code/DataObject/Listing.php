<?php
 
class Listing extends DataObject {
 
	
	private static $db = array(	
		"Name"			=> "Varchar(255)",
		"AddressLineOne"=> "Varchar(255)",
		"AddressLineTwo"=> "Varchar(255)",
		"Town"			=> 'Varchar(255)',
		"County"		=> 'Varchar(255)',
		"PostCode"		=> 'Varchar(255)',
		"PhoneNumber"	=> 'VarchaR(255)',
		"Website"		=> 'Varchar(255)',
		"URLSlug"		=> 'Varchar(255)',
		"Description"	=> 'HTMLText',
		"Lat"			=> 'Varchar',
		"Long"			=> 'Varchar'
	);
 
	// One-to-one relationship with gallery page
	private static $has_one = array(
		"Member"	=> "Member"
		// ListingCategory
	);

	private static $has_many = array(
		// openning hours here.
		// social links, each link has a type dropdown ?or custom?
		// reviews
		// Photos
		// ?enquiries?
	);

	private static $belongs_many_many = array(
	);
 
 // tidy up the CMS by not showing these fields
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		// $fields->removeFieldFromTab("Root.Main","SortOrder");
		return $fields;
	}
	
	// need onBeforeWrite to create the URL, calculate Lat/Long (MN does this)

	// Tell the datagrid what fields to show in the table
	//  private static $summary_fields = array( 
	// 	'Process.Name'    => array("title" => 'Process'),
	// 	'Name'  		  => array("title" => 'Alias'),
	// 	'ApprovedStatus'  => array("title" => 'Approved')
	//  );

	// private static $searchable_fields = array(
	// 	'Process.Name'    => array("title" => 'Process'),
	// 	'Name'  		  => array("title" => 'Alias'),
	// 	'Approved'  	  => array("title" => 'Approved')
	// );
}