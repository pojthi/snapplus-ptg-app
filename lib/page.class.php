<?php
class Page
{
	public $pagesize;
	

    public function __construct() {		
    }
	
	public function PageSize($size = null){
		$this->pagesize = ($size === null)?10:$size;  // default 10
		return $this->pagesize;
	}
	
	
	public function Pagination(){
		$url = "";
		
		return $url;
	}
	
	
	//*************************************************//
	public function curGet(array $params = NULL, $use_get = TRUE)
	{
		if ($use_get)
		{
			if ($params === NULL)
			{
				// Use only the current parameters
				$params = $_GET;
			}
			else
			{
				// Merge the current and new parameters
				$params = array_merge($_GET, $params);
			}
		}

		if (empty($params))
		{
			// No query parameters
			return '';
		}

		// Note: http_build_query returns an empty string for a params array with only NULL values
		$query = http_build_query($params, '', '&');

		// Don't prepend '?' to an empty string
		return ($query === '') ? '' : '?'.$query;
	}
	
	public function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}
	
	public function getPageName() {
	 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	}
	


	public function getActive($role,$page){
		if($levelid!=0){//not admin
			if(((int)$per)==0)
			return " style=display:none; ";
		}
		return "";
	}
	
	
	
}//end class

?>