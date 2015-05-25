<?php

//class NewsHolder extends Page {
//	static $allowed_children = array('NewsPage');
//	static $default_child = 'NewsPage';
//	static $icon = "themes/express/images/icons/sitetree_images/news_listing.png";
//	public $pageIcon =  "images/icons/sitetree_images/news_listing.png";
//
//	public function MenuChildren() {
//		return parent::MenuChildren()->exclude('ClassName', 'NewsPage');
//	}
//
//	public function getCategories() {
//		return NewsCategory::get()->sort('Title', 'DESC');
//	}
//
//	public function getDefaultRSSLink() {
//		return $this->Link('rss');
//	}
//}
//
//class NewsHolder_Controller extends Page_Controller {
//
//	public function init() {
//		parent::init();
//
//		RSSFeed::linkToFeed($this->Link() . 'rss', SiteConfig::current_site_config()->Title . ' news');
//	}
//
//	public function getNewsItems($pageSize = 10) {
//		$items = DataObject::get('NewsPage', "ParentID = $this->ID")->sort('Date', 'DESC');
//		$category = $this->getCategory();
//		if ($category) $items = $items->filter('CategoryID', $category->ID);
//		$list = new PaginatedList($items, $this->request);
//		$list->setPageLength($pageSize);
//		return $list;
//	}
//
//	public function getCategory() {
//		$categoryID = $this->request->getVar('category');
//		if (!is_null($categoryID)) {
//			return NewsCategory::get_by_id('NewsCategory', $categoryID);
//		}
//	}
//
//	public function rss() {
//		$rss = new RSSFeed($this->Children(), $this->Link, SiteConfig::current_site_config()->Title . ' news');
//		return $rss->outputToBrowser();
//	}
//}
 
class NewsGridHolder extends GridFieldPageHolder {

	private static $singular_name = 'NewsHolder';
	private static $plural_name = 'NewsHolders';
	private static $description = 'Create a page to contain your news items/archive';
	
	private static $hide_ancestor = 'GridFieldPageHolder';
	private static $allowed_children = array('*NewsGridPage');
	private static $default_child = "NewsGridPage";
	
	public static $icon = 'newsgrid/images/newsholder.png';
	
	static $add_default_gridfield = false; // set to false so GridFieldPage doesn't add standard gridfield

    static $db = array(
		'ItemsPerPage' => 'Int',
    );
	
    static $has_one = array(
    );
     
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		// NewsGrid
		$gridFieldConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewSiteTreeItemButton('toolbar-header-right'),
			new GridFieldSortableHeader(),
			new GridFieldFilterHeader(),
			$dataColumns = new GridFieldDataColumns(),
			new GridFieldPaginator(20),
			new GridFieldEditSiteTreeItemButton()
		);
		$dataColumns->setDisplayFields(array(
			'Title' => 'Title',
			'URLSegment'=> 'URL',
			'formattedPublishDate' => 'Publish date',
			'getStatus' => 'Status',
			'LastEdited' => 'Changed',
		));

		// include both live and stage versions of pages
		$pages = $this->AllChildrenIncludingDeleted()->sort('Date', 'DESC');

		// use gridfield as normal;
		$gridField = new GridField("Subpages", "Manage Newsitems", 
			$pages, $gridFieldConfig);

		$gridField->setModelClass(self::$default_child);
		//$gridField->setModelClass("GridFieldPage"); // prevents "GridField doesn't have a modelClassName" error

		$fields->addFieldToTab("Root.Subpages", $gridField);
		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
	
	public function SortedChildren(){ 
		
		return $this->Children()->sort('Date', 'DESC');
		
		// $children will be a DataObjectSet 
		$children = $this->Children();

		if( !$children ) 
		return null; // no children, nothing to work with

		// optionally: sort on some other field, like Date (override from subclass)
		$children->sort('Date', 'DESC');
		
		// M: gridnews
		if($this->ItemsPerPage && $this->ItemsPerPage > 0) {
			$ctrlr = Controller::curr();
			$children = new PaginatedList($children, $ctrlr->request);
			$children->setPageLength($this->ItemsPerPage);
		}
		// M: END gridnews

		// return sorted set 
		return $children; 
	}
	
	
}
 
class NewsGridHolder_Controller extends GridFieldPageHolder_Controller {
	
	// redirect this page to its first child page (better to implement on link() in Model)
//	public function index(){
//		if($children = $this->Children()){
//			$children->sort('Date','DESC');
//			if($firstChild = $children->limit(1)){
//				$firstChild1 = $firstChild[0];
//				$this->redirect($firstChild1->Link());
//			}
//		}
//	}
	
}