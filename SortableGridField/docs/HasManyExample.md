has_many Example
=================
Please note this example is written with 3.0.x in mind, if you are using 3.1.x make sure you scope all static properties to private not public.
```php
/*** TestPage.php ***/
class TestPage extends Page {
	public static $has_many=array(
		'TestObjects'=>'TestObject'
	);
	
	public function getCMSFields() {
		$fields=parent::getCMSFields();
		
		$conf=GridFieldConfig_RelationEditor::create(10);
		$conf->addComponent(new GridFieldSortableRows('SortOrder'));
		
		$fields->addFieldToTab('Root.TestObjects', new GridField('TestObjects', 'TestObjects', $this->TestObjects(), $conf));
		
		return $fields;
	}
}


/*** TestObject.php ***/
class TestObject extends DataObject {
	public static $db=array(
		'Title'=>'Text',
		'SortOrder'=>'Int'
	);
    
    public static $has_one=array(
        'Parent'=>'TestPage'
    );
	
	public static $default_sort='SortOrder';
}
```