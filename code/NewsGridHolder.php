<?php
 
class NewsGridHolder extends GridFieldPageHolder {

	public static $icon = 'newsgrid/images/newsholder.png';

    static $db = array(
		'ItemsPerPage' => 'Int',
    );
	
    static $has_one = array(
    );

    static $allowed_children = array('*NewsGridPage');
	static $default_child = "NewsGridPage";
	static $add_default_gridfield = false; // set to false so GridFieldPage doesn't add standard gridfield
     
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
		$pages = $this->AllChildrenIncludingDeleted();

		// use gridfield as normal;
		$gridField = new GridField("Subpages", "Manage Newsitems", 
			$pages, $gridFieldConfig);

		$gridField->setModelClass(self::$default_child);
		//$gridField->setModelClass("GridFieldPage"); // prevents "GridField doesn't have a modelClassName" error

		$fields->addFieldToTab("Root.Subpages", $gridField);
		
		return $fields;
	}
	
	public function SortedChildren(){ 
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