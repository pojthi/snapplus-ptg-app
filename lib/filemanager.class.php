<?php
require_once 'config.php';
require_once "WindowsAzure/WindowsAzure.php"; 
require_once 'vendor/autoload.php';
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;

class FileManager {

    public function createWatermark($sorceName, $empId, $loc) {

        $im     = imagecreatefromjpeg($sorceName);
        $stamp  = imagecreatetruecolor(imagesx($im), 70);
        $date   = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
        $ddMMyy = $date -> format('d-m-Y H:i:s');
    
        $line1 = $empId;//." on ".$ddMMyy;
        $line2 = $ddMMyy;
        $line3 = $loc;
    
        imagestring($stamp, 5, 5, 10, $line1, 0xFFFFFF);
        imagestring($stamp, 4, 5, 30, $line2, 0xFFFFFF);
        imagestring($stamp, 4, 5, 50, $line3, 0xFFFFFF);
     
        $sourcefile_width  = imageSX($im);
        $sourcefile_height = imageSY($im);
        $insertfile_width  = imageSX($im);
        $insertfile_height = 70;
        $transition        = 50;
        
        $dest_x = 0;
        $dest_y = $sourcefile_height - $insertfile_height;
        
        imageCopyMerge($im, $stamp, $dest_x, $dest_y, 0, 0, $insertfile_width, $insertfile_height, $transition);
        // Save the image to file and free memory
        imagepng($im, $sorceName);
        imagedestroy($im);
    }

    public function uploadBlob($sorceName) {
        $blobRestProxy = ServicesBuilder::getInstance() -> createBlobService(Azure_Blob_Conenction);
        $content = fopen($sorceName, "r");
        try {
            $blobRestProxy -> createBlockBlob(Azure_Blob_Container, $sorceName, $content);
        } catch(ServiceException $e) {
            $code = $e -> getCode();
            $error_message = $e -> getMessage();
        }

        $blobRestProxy  = null;
    }
}
?>