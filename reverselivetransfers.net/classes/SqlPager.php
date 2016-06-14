<?php
/**-***********************************************************************************************
***************************************************************************************************
* Takes in a SQL query and makes a paging system to display the results of the query. Uses there
* 		LIMIT keyword to divide the result into sections.
***************************************************************************************************/
class SqlPager {
	////////////////////////////////// Public Variables /////////////////////////////
	var $items_per_page = 25;
	var $query = "";
	var $page  = 1;
	var $sqli;
	//Options
	var $opt_links_count = 5; 		//Number of Page Number links shown at the bottom - if 0, show all links.
	//Display Texts
	var $opt_texts = array(
		'back' => '&lt;',     'next' => '&gt;',		//Next and Previous Texts
		'first'=> '&lt;&lt;', 'last' => '&gt;&gt;',	//First and Last Links
		'current_page_indicator_left'=>'','current_page_indicator_right'=>'',
		'links_seperator' => " "					//The text used to seperate the links(Page numbers). 
	);

	///////////////////////////////// (Idealy) Private Variables //////////////////////////////
	//These should be private variables - but I don't know how to make them private in PHP4
	var $_total_items = 0; //Total number of items
	var $_total_pages = 0; //Total number of pages
	var $_page_link   = "";//The text that must be used while making links to other pages.

	/**
	* Constructor
	*/
	function SqlPager($sqli,$query,$page_link="",$items_per_page=25) {
		$query = preg_replace("/LIMIT [0-9]+,[0-9]+/i","",$query); //Remove the LIMIT option if there is one.
		//Get all the options that must be there.
		$this->query = $query;
		$this->sqli = $sqli;
		//Number of items that must be displayed in one page.
		$this->items_per_page = ($_REQUEST['items_per_page']) ? $_REQUEST['items_per_page'] : $items_per_page;
		$items_per_page = $this->items_per_page;
		
		//The pager is located in which page... Used to give the page numbers as a GET request.
		$page_link = ($page_link) ? $page_link : basename($_SERVER['PHP_SELF']).'?';
		$last_char = $page_link[strlen($page_link)-1];
		if($last_char != '&' and $last_char != '?') { //If the given page dont end with a ? or a &,
			if(strpos($page_link,'?') === false) $page_link .= '?';// Add the '?' if there is no '?'
			else $page_link .= '&'; //If there is a '?', add a '&' at the end.
		}
		//Add the items per page option to the page link.
		if($_REQUEST['items_per_page']) {
			$page_link .= "items_per_page=$items_per_page&";
		}
		$this->_page_link = $page_link;

		$this->page = ($_REQUEST['page']) ? $_REQUEST['page'] : 1; //Get the current page we are on.
		$optionsArray  = explode("UNION",$query);
foreach($optionsArray as $options)
{
		$options = preg_replace("/^SELECT .+? FROM (.+)$/i","$1",trim($options));
		$options = preg_replace("/Group By (.+)$/i","",$options);
		//echo "SELECT count(*) AS count FROM $options";
		$sql_count=$sqli->get_selectData("SELECT count(*) AS count FROM $options") ;
		
		$this->_total_items += $sql_count[0]['count'];
}
		$this->_total_pages = ceil($this->_total_items/$items_per_page); //And total pages
	 	}

///////////////////////////////////// Member Functions ///////////////////////////////////

/////////////////////////////////// Returning Functions //////////////////////////////////
	/** Function : getPage()
	* Returns : Array
	* Return all data to be shown on this page as a array.
	*/
	function setTotalPages($total_items)
	{$this->_total_pages = ceil($total_items/$this->items_per_page);}
	
	function getPage() {
		$query = $this->query;
		$arr = array();

		//Break the result into sections using the LIMIT keyword.
		$from = ($this->page-1) * $this->items_per_page;
		$query .= " LIMIT $from,$this->items_per_page";

		//Get the data from the Database
		$result = $this->sqli->get_selectData($query);

				return $result;
	}

	/** Function : getSqlHandle()
	* Return the MySQL Handle of the query.
	*/
	function getSqlHandle() {
		$query = $this->query;

		//Break the result into sections using the LIMIT keyword.
		$from = ($this->page-1) * $this->items_per_page;
		$query .= " LIMIT $from,$this->items_per_page";

		//Get the Handle of the Database
		$result = mysql_query($query) or die("MySQL Error : " . mysql_error() . "<br />" . $query);

		return $result;
	}

	/** Function : getLink()
	* Arguments  : $dir - String 
    *					- can be 'next' or 'back' - 'next' get the next link ad 'back' get the previous link.
	*					- can be 'first' or 'last'- Link to the first or last page.	
	* Returns    : The HTML of the link.
	* Return the Next/Previous and Firs/Last Links based on the argument...
	*/
	function getLink($dir="next") {
		$dir = strtolower($dir);
		$text = $this->opt_texts; //Get all Options

		//We just make the template here. Depending on the value of '$dir' the values to be inserted in 
		//		the place of the replacement texts(like %%PAGE%%) will change.
		$template = '<a id="SqlPager-'.$dir.'" href="'. $this->_page_link .'page=%%PAGE%%" class="page-%%CLASS%%">%%TEXT%%</a>' ."\n"; //Template
		$replace_these = array("%%PAGE%%","%%CLASS%%","%%TEXT%%"); //Stuff to replace

		if($dir == "previous" || $dir == "back") { //Get the back link
			$back = $this->page-1;
			$back = ($back > 0) ? $back : 1; //Never let the value of $back be lesser than 1(first page)
	
			$with_these = array($back,"back",$text['back']);

		} elseif($dir == "next" || $dir == "forward") { //Get the forward link
			$next = $this->page+1;
			$next = ($next > $this->_total_pages) ? $this->_total_pages : $next; //Never let the value of $next go beyond the total number of pages
			
			$with_these = array($next,"next",$text['next']);
 		}
		
		elseif($dir == "first" || $dir == "start") { //Get the first link
			$with_these = array(1,"first",$text['first']);

		} elseif($dir == "last" || $dir == "end") { //Get the last link.
			$with_these = array($this->_total_pages,"last",$text['last']);
		}
		$link = str_replace($replace_these,$with_these,$template); //Replace the texts
		
		return $link;
	}

////////////////////////////////////////// Display Functions /////////////////////////////////////

	/** Function : showPager()
	* Arguments  : 	$show_numbers       : 1/0 - Show the page number links
	*				$show_next_previous : 1/0 - Shows the Next and Previous links at the beginning and end of links
	*				$show_first_last	: 1/0 - Shows the links to the first and last page.	
	* Show the pager - a list of page numbers that will act like links to that page - the current page won't be
	*	a link. Also includes a Next and Back link at the start and end.
	*/
	function showPager($show_numbers=1, $show_next_previous=1, $show_first_last=0) {
		$page = $this->page; //Current Page
		$max = $this->opt_links_count; //Number of page number links to be displayed
		
		if($this->_total_pages == 1) return; //No need to display pager if only one page is there.

		//Decides which page number should be the first in page number display.
		//	For example, the 'opt_links_count' has the value '5'. This means that 5 page numbers will be displayed.
		//	So if we are on page 1, the displayed numbers will be [1] 2 3 4 5. If we are on page 5, the displayed 
		//	numbers will be 3 4 [5] 6 7. If we are on page 9(And the total number of pages are also 9, the 
		//	displayed numbers will be 5 6 7 8 [9]
		//	For the following comments, we are assuming that 
		//		'opt_links_count' is 5, we are at page '4' in total '9' pages.
		//		So... opt_links_count($max)=5 ; $page = 4; $_total_pages  = 9;
		if($this->opt_links_count) {
			$start_from = $page - round($max/2) + 1; 			// = 4 - round(5/2) + 1 = 4-3+1 = 2
			$start_from = ($this->_total_pages - $start_from < $max) ? $this->_total_pages - $max + 1 : $start_from ; //(9-2) < 9 ? If yes, 9-5+1. | If no, no change.
			$start_from = ($start_from > 1) ? $start_from : 1;	// If it is lesser than 1, make it 1(all paging must start at the '1' page as it is the first page) : = 2
		} else { // If $opt_links_count is 0, show all pages
			$start_from = 1;
			$max = $this->_total_pages;
		}

		if($this->opt_texts['first'] and $show_first_last and $page > 1)
			print $this->getLink("first"); //Link to First Page

		//Print the 'Previous' Link
		if($page > 1 and $show_next_previous)
			print $this->getLink("back");

		//Initializations
		$i = $start_from;
		$count = 0;

		if($show_numbers) {
			//Display '$opt_links_count' number of links
			while ($count++ < $max) {
				if($i == $page) print " <span class=\"pages-text-red\">" 
					. $this->opt_texts['current_page_indicator_left'] . $i . $this->opt_texts['current_page_indicator_right']
					. "</span>" . $this->opt_texts['links_seperator'];
			
				else print "&nbsp;<a href=\"$this->_page_link" . "page=$i\" class=\"pages-text-blue\" title='Page $i'>$i</a>&nbsp;" . $this->opt_texts['links_seperator'];
				$i++;

				if($i > $this->_total_pages) break; //If the current page exceeds the total number of pages, get out.
			}
		}

		//Print the 'Next' Link
		if($page < $this->_total_pages and $show_next_previous)
			print  "\n" . $this->getLink("next");

		if($page < $this->_total_pages and $this->opt_texts['last'] and $show_first_last) 
			print $this->getLink("last"); //Link to the last page.
	}

	/** Function : showGoToBox()
	* Input box based navigation. Shows a Input box where the users can type in a page number to go 
	* to that page number. Very useful for sites with a large number of pages.
	*/
	function showGoToBox() {
		print <<<END
<script language="javascript" type="text/javascript">
function goToPageBox(page) {
	if(page > $this->_total_pages || page < 1) 
		alert("Invalid page number. Please use a number between 1 and $this->_total_pages");
	else
		document.location.href = "$this->_page_link" + "page="+page;
	return false;
}
</script>

<form name="goto_page_entry" onSubmit="return goToPageBox(document.goto_page_entry.page_number.value)">
Page <input type="text" name="page_number" size="4" value="$this->page" />
<input type="submit" name="submit" value="Go" /> of $this->_total_pages <!-- (in $this->_total_items results) --> 
</form>
END;
	}

	/** Function : showGoToDropDown()
	* Dropdown menu based navigation. Shows a Dropdown menu which has all the pages. User can choose one page, 
	* 	and the he/she will be taken to that page.
	*/
	function showGoToDropDown() {
		print <<<END
<script language="javascript" type="text/javascript">
function goToPageDropDown(page) {
	document.location.href = "$this->_page_link" + "page="+page;
	return false;
}
</script>

<form name="goto_page_dropdown" onSubmit="return goToPageDropDown(this.page_number.value)"   >
<span class="blacktxt11">Page </span><select name="page_number" onchange="goToPageDropDown(this.value)" size="1">
END;
		for($i=1;$i<=$this->_total_pages;$i++) {
			$sel="";
			if($i == $this->page) $sel = "selected='selected'"; //Make sure the current page is selected.
			print "	<option value='$i'$sel>$i</option>";
		}
		print "</select></form>";
	}

	/** Function : showItemsPerPageChooser()
	* Shows a Dropdown menu with values 5,10,15 to 50. On selecting one option, that much items will be
	*	shown in one page.
	*/
	function showItemsPerPageChooser() {
		print <<<END
<script language="javascript" type="text/javascript">
function itemsPerPageChooser(number) {
	var link = "$this->_page_link";
	if(link.indexOf('items_per_page=')+1) {
		link = link.replace(/items_per_page=\d+/,'');
	}
	if(!link) link = "";
	document.location.href = link + "items_per_page="+number;
	return false;
}
</script>

<form class="niceform"><span class="blacktxt11"> Per Page </span> <select name="number" onchange="itemsPerPageChooser(this.value)" size="1" id="no-of-page"> 
END;
		for($i=5; $i<=100; $i+=5) {
			$sel="";
			if($i == $this->items_per_page) $sel = "selected='selected'"; //Make sure the current page is selected.
			print "	<option value='$i'$sel>$i</option>";
		}
		print "</select></form>";
	}
	
	
	
		function showItemsPerPageChooser1() {
		print <<<END
<script language="javascript" type="text/javascript">
function itemsPerPageChooser(number) {
	var link = "$this->_page_link";
	if(link.indexOf('items_per_page=')+1) {
		link = link.replace(/items_per_page=\d+/,'');
	}
	if(!link) link = "";
	document.location.href = link + "items_per_page="+number;
	return false;
}
</script>

<form action=""><span class="blacktxt11"> Per Page </span> <select name="number" onchange="itemsPerPageChooser(this.value)" size="1" id="no-of-page"> 
END;
			if(50 == $this->items_per_page) $sel = "selected='selected'";
            else $sel ="";
			print "	<option value='50' $sel>50</option>";
            
       if(100 == $this->items_per_page) $sel = "selected='selected'";
            else $sel ="";
			print "	<option value='100' $sel>100</option>";
            
     if(500 == $this->items_per_page) $sel = "selected='selected'";
            else $sel ="";
			print "	<option value='500'$sel>500</option>";
            
         if(1000 == $this->items_per_page) $sel = "selected='selected'";
            else $sel ="";
			print "	<option value='1000'$sel>1000</option>";
		print "</select></form>";
	}
	
	/** Function : showStatus()
	* Shows the status of the current page that is being viewed for example,
	*	'Viewing 1-30 of 53'
	*/
	function showStatus() {
		$from = ($this->page * $this->items_per_page) - $this->items_per_page + 1;
		$to = $from + $this->items_per_page - 1;
		$to = ($to > $this->_total_items) ? $this->_total_items : $to;
		$status = "Viewing $from - $to of $this->_total_items";
		
		print $status;
	}
}

/************************************* TODO *************************************
* Display data using a given template. (?)
* The page numbers on the bottom will change - 1 2 3 - when the user clicks on next, it will become 4 5 6, then 7 8 9 etc.
* Use MySQL Class(?)
********************************************************************************/
/************************************** History ********************************
* 1.00.E - Wednesday, January 11 2006
*	Implimented the 'current_page_indicator_left' and the 'current_page_indicator_right' in the 'opt_texts'
*		array.
*
* 1.00.C - Thursday, August 25 2005
*	Fixed a bug in showItemsPerPageChooser() funtion
*	Fixed bug in showStatus() Function.
*
* 1.00.A - Friday, December 02 2005
*	Gave IDs for all links
********************************************************************************/
?>
