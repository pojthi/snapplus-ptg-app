<? 
	$message="";
	$filename = time()."_".$_FILES['upload']['name'];
	$urlupload = '../../upload/quiz/'. $filename;
	$urllink =  'upload/quiz/';
	
 //extensive suitability check before doing anything with the file...
    if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
    {
       $message = "No file uploaded.";
    }
    else if ($_FILES['upload']["size"] == 0)
    {
       $message = "The file is of zero length.";
    }
    else if (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png") AND ($_FILES['upload']["type"] != "image/gif"))
    {
       $message = "The image must be in either GIF , JPG or PNG format. Please upload a JPG or PNG instead.";
    }
	else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
    {
       $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
    }
    else {
      $message = "";
	
      $move =  move_uploaded_file($_FILES['upload']['tmp_name'], $urlupload);
      if(!$move)
      {
         $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
      }      
    }

	
	if($message != "")
	{
		$urlupload = "";
	}
	
	$funcNum = $_GET['CKEditorFuncNum'] ;	
	echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$urllink$filename', '$message');</script>";

?>