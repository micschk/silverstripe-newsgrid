<?php

//class NewsPage extends Page {
//	static $default_parent = 'NewsHolderPage';
//	static $can_be_root = false;
//	static $icon = "themes/express/images/icons/sitetree_images/news.png";
//	public $pageIcon =  "images/icons/sitetree_images/news.png";
//
//	static $db = array(
//		'Date' => 'SS_Datetime',
//		'Abstract' => 'Text',
//		'Author' => 'Varchar(255)'
//	);
//
//	static $has_one = array(
//		'Category' => 'NewsCategory'
//	);
//
//	/**
//	 * Add the default for the Date being the current day.
//	 */
//	public function populateDefaults() {
//		parent::populateDefaults();
//
//		if(!isset($this->Date) || $this->Date === null) {
//			$this->Date = SS_Datetime::now()->Format('Y-m-d H:i:s');
//		}
//	}
//
//	public function getCMSFields() {
//		$fields = parent::getCMSFields();
//
//		$fields->addFieldToTab('Root.Main', $dateTimeField = new DatetimeField('Date'), 'Content');
//		$dateTimeField->getDateField()->setConfig('showcalendar', true);
//
//		$categories = NewsCategory::get()->sort('Title ASC');
//		if ($categories && $categories->exists()) {
//			$fields->addFieldToTab('Root.Main', new DropdownField('CategoryID', 'Category', $categories->map()), 'Content');
//		}
//
//		$fields->addFieldToTab('Root.Main', new TextareaField('Abstract'), 'Content');
//
//		return $fields;
//	}
//}

class NewsGridPage extends GridFieldPage
{
    
    private static $singular_name = 'NewsItem';
    private static $plural_name = 'NewsItems';
    private static $description = 'Create a news item';
    
    private static $can_be_root = false;
    private static $hide_ancestor = 'GridFieldPage';
    private static $allowed_children = "none";
    
    public static $icon = 'newsgrid/images/newsholder.png';
    
    //static $default_sort = "Date DESC";

    public static $db = array(
        'Date' => 'Date',
    );
    
    public function formattedPublishDate()
    {
        return $this->obj('Date')->Format('Y-m-d');
    }

    public function populateDefaults()
    {
        $this->Date = date('dd-MM-yyyy');
        parent::populateDefaults();
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $Datepckr = new DateField('Date');
        $Datepckr->setConfig('dateformat', 'dd-MM-yyyy'); // global setting
        $Datepckr->setConfig('showcalendar', 1); // field-specific setting
        $fields->addFieldToTab("Root.Main", $Datepckr, 'Content');

        return $fields;
    }
}
 
class NewsGridPage_Controller extends GridFieldPage_Controller
{
}
