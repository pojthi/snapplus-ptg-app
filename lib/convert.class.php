<?php
class Convert{

	public function formatnumber($value,$format = 0) {
		$value = ($value == null)?0:$value;
		return number_format($value,$format);
	}

	public function toint($value) {
		$value = ($value == null)?0:$value;
		$value = str_replace(",","",$value);
		$value = (int)($value == null || $value == "")?0:$value;
		return $value;
	}	
	
	public function todouble($value) {
		$value = str_replace(",","",$value);
		$value = (double)($value == null || $value == "")?0:$value;
		return $value;
	}				
	
	public function formatphone($phone) {
		$value = preg_replace("/[^\d]/", "", $phone);		
		switch(strlen($value) ){
			case 9:
					$value = preg_replace("/^1?(\d{2})(\d{3})(\d{4})$/", "$1-$2-$3", $value);
					break;
			case 10:
					$value = preg_replace("/^1?(\d{2})(\d{3})(\d{4})(\d{1})$/", "$1-$2-$3-$4", $value);
					break;
			default:
					$value = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $value);
					break;
		}
				
		return $value;
		//return number_format($value,$format);
	}
	
	//format date
	public function formatdate($date,$format = null) {
		if($date=="")return "";
		$format=($format=="" || $format == null)?"d/m/Y":$format;		
		return date($format,strtotime($date));
	}	
	//end format date
	
	//format time
	public function formattime($time) {		
		if($time == null){
			$value = "";
		}else{
			$value = date("H:i",strtotime($time)); 
		}
		return $value;
	}	
	//end format time
		
	
	
	public function tosysdate($date){	
		if($date=="")return null;
		$length = strrpos($date," ");
		$arr = explode( "/" , substr($date,$length));		
		return $arr[2]."/".$arr[1]."/".$arr[0];
	}
	
	public function tosysdatetime($date,$time){	
		if($date=="")return null;
		$length = strrpos($date," ");
		$arr = explode( "/" , substr($date,$length));		
		return trim($arr[2]."/".$arr[1]."/".$arr[0]." ".$time);
	}	
	
	public function numtosql($num){				
		if($num=="")return "NULL";
		$value =  str_replace(',','',$num);		
		return $value;
	}	
	
	public function weekday($date){	
		return date('D', strtotime( $date));		
	}	
	
	public function tomonthname($month,$th = 0){
		$th =  ($th == null || $th == '') ? 0 : 1;
		switch($month){
			case 1:
				$name = ($th==1)?"มกราคม":"January";
				break;
			case 2:
				$name = ($th==1)?"กุมภาพันธ์":"February";
				break;
			case 3:
				$name = ($th==1)?"มีนาคม":"March";				
				break;
			case 4:
				$name = ($th==1)?"เมษายน":"April";	
				break;
			case 5:
				$name = ($th==1)?"พฤษภาคม":"May";	
				break;
			case 6:
				$name = ($th==1)?"มิถุนายน":"June";	
				break;
			case 7:
				$name = ($th==1)?"กรกฎาคม":"July";	
				break;
			case 8:
				$name = ($th==1)?"สิงหาคม":"August";	
				break;
			case 9:
				$name = ($th==1)?"กันยายน":"September";	
				break;
			case 10:
				$name = ($th==1)?"ตุลาคม":"October";	
				break;
			case 11:
				$name = ($th==1)?"พฤษจิกายน":"November";	
				break;
			case 12:
				$name = ($th==1)?"ธันวาคม":"December";	
				break;		
		}
		return $name;
	}
	
	
	public function tomonthshortname($month,$th = 0){
		$th =  ($th == null || $th == '') ? 0 : 1;
		switch($month){
			case 1:
				$name = ($th==1)?"ม.ค.":"Jan";
				break;
			case 2:
				$name = ($th==1)?"ก.พ.":"Feb";
				break;
			case 3:
				$name = ($th==1)?"มี.ค.":"Mar";				
				break;
			case 4:
				$name = ($th==1)?"เม.ย.":"Apr";	
				break;
			case 5:
				$name = ($th==1)?"พ.ค.":"May";	
				break;
			case 6:
				$name = ($th==1)?"มิ.ย.":"Jun";	
				break;
			case 7:
				$name = ($th==1)?"ก.ค.":"Jul";	
				break;
			case 8:
				$name = ($th==1)?"ส.ค.":"Aug";	
				break;
			case 9:
				$name = ($th==1)?"ก.ย.":"Sep";	
				break;
			case 10:
				$name = ($th==1)?"ต.ค.":"Oct";	
				break;
			case 11:
				$name = ($th==1)?"พ.ย.":"Nov";	
				break;
			case 12:
				$name = ($th==1)?"ธ.ค.":"Dec";	
				break;		
		}
		return $name;
	}
	
	
	public function formatshortdate($date,$th = 0){
		if($date=="")return "";
		$length = strrpos($date," ");
		$arr = explode( "/" , substr($date,$length));		
		$name = "";
		$year = $arr[2];
		$month = $arr[1];
		$day = $arr[0];
		
		$th =  ($th == null || $th == '') ? 0 : 1;
		switch($month){
			case 1:
				$name = ($th==1)?"ม.ค.":"Jan";
				break;
			case 2:
				$name = ($th==1)?"ก.พ.":"Feb";
				break;
			case 3:
				$name = ($th==1)?"มี.ค.":"Mar";				
				break;
			case 4:
				$name = ($th==1)?"เม.ษ.":"Apr";	
				break;
			case 5:
				$name = ($th==1)?"พ.ค.":"May";	
				break;
			case 6:
				$name = ($th==1)?"มิ.ย.":"Jun";	
				break;
			case 7:
				$name = ($th==1)?"ก.ค.":"Jul";	
				break;
			case 8:
				$name = ($th==1)?"ส.ค.":"Aug";	
				break;
			case 9:
				$name = ($th==1)?"ก.ย.":"Sep";	
				break;
			case 10:
				$name = ($th==1)?"ต.ค.":"Oct";	
				break;
			case 11:
				$name = ($th==1)?"พ.ย.":"Nov";	
				break;
			case 12:
				$name = ($th==1)?"ธ.ค.":"Dec";	
				break;		
		}
		return $day." ".$name." ".$year;
	}
		
	
	function dayofweek($week,$th=0){
		$name="";
		$th =  ($th == null || $th == '') ? 0 : 1;
		switch($week){		
			case 0:$name = ($th==1)?"จ":"Mon";break;
			case 1:$name = ($th==1)?"อ":"Tue";break;
			case 2:$name = ($th==1)?"พ":"Wed";break;
			case 3:$name = ($th==1)?"พฤ":"Thu";break;
			case 4:$name = ($th==1)?"ศ":"Fri";break;
			case 5:$name = ($th==1)?"ส":"Sat";break;
			case 6:$name = ($th==1)?"อ":"Sun";break;
		}
		return $name;
	}	
	
	public function toperiodtime($p){
		$next = $p+1;
		return str_pad($p,2, '0', STR_PAD_LEFT).":00-".str_pad($next, 2, '0', STR_PAD_LEFT).":00";
	}	
	
	public function docperiod($date){
		$date =  str_replace('/', '-', $date);
		return date('ym', strtotime($date));
	}
	
		
	function texttosql($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function texttohtml($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars_decode($data);
		return $data;
	}
	
	function nl2br($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars_decode($data);
		return nl2br($data);
	}	
	
	function br2nl($data)
	{
		$data = trim($data);
		$data = addslashes($data);
		//$data = htmlspecialchars($data);		
		return preg_replace('/\<br(\s*)?\/?\>/i', "", $data);
	}	
	
	function engFormat($number){
			list($thb, $ths) = explode('.', $thb);
			$ths = substr($ths.'00', 0, 2);
			$max_size = pow(10, 18);
			if (!$number) return "zero";
			if (is_int($number) && $number < abs($max_size)) {
				switch ($number) {
						case $number < 0:
								$prefix = "negative";
								$suffix = Convert::engFormat(-1 * $number);
								$string = $prefix." ".$suffix;
								break;
						 case 1:
								$string = "one"; break;
						 case 2:
								$string = "two";break;
						 case 3:
								$string = "three";break;
						 case 4:
								$string = "four";break;
						 case 5:
								$string = "five";break;
						 case 6:
								$string = "six";break;
						 case 7:
								$string = "seven";break;
						 case 8:
								$string = "eight";break;
						 case 9:
								$string = "nine";break;
						 case 10:
								$string = "ten";break;
						 case 11:
								$string = "eleven";break;
						 case 12:
								$string = "twelve";break;
						 case 13:
								$string = "thirteen";break;
						 case 15:
								$string = "fifteen";break;
						 case $number < 20:
								  $string = Convert::engFormat($number % 10);
								  if ($number == 18) {
								   $suffix = "een";
								  } else {
								   $suffix = "teen";
								  }
								  $string .= $suffix;
								  break;
						 case 20:
								$string = "twenty";break;
						 case 30:
								$string = "thirty";break;
						 case 40:
								$string = "forty";break;
						 case 50:
								$string = "fifty";break;
						 case 60:
								$string = "sixty";break;
						 case 70:
								$string = "seventy";break;
						 case 80:
								$string = "eighty";break;
						 case 90:
								$string = "ninety";break;
						 case $number < 100:
								  $prefix = Convert::engFormat($number - $number % 10);
								  $suffix = Convert::engFormat($number % 10);
								  $string = $prefix."-".$suffix;
								  break;
						 case $number < pow(10, 3):
								  $prefix = Convert::engFormat(intval(floor($number / pow(10, 2))))." hundred";
								  if ($number % pow(10, 2))
								   $suffix = " and ".Convert::engFormat($number % pow(10, 2));
								  $string = $prefix.$suffix;
								  break;
						 case $number < pow(10, 6):
								  $prefix = Convert::engFormat(intval(floor($number / pow(10, 3))))." thousand";
								  if ($number % pow(10, 3))
								   $suffix = Convert::engFormat($number % pow(10, 3));
								  $string = $prefix." ".$suffix;
								  break;
						 case $number < pow(10, 9):
								  $prefix = Convert::engFormat(intval(floor($number / pow(10, 6))))." million";
								  if ($number % pow(10, 6))
								   $suffix = Convert::engFormat($number % pow(10, 6));
								  $string = $prefix." ".$suffix;
								  break;
						 case $number < pow(10, 12):
								  $prefix = Convert::engFormat(intval(floor($number / pow(10, 9))))." billion";
								  if ($number % pow(10, 9))
								   $suffix = Convert::engFormat($number % pow(10, 9));
								  $string = $prefix." ".$suffix;
								  break;
						 case $number < pow(10, 15):
								  $prefix = Convert::engFormat(intval(floor($number / pow(10, 12))))." trillion";
								  if ($number % pow(10, 12))
								   $suffix = Convert::engFormat($number % pow(10, 12));
								  $string = $prefix." ".$suffix;
								  break;
						 case $number < pow(10, 18):
								  $prefix = Convert::engFormat(intval(floor($number / pow(10, 15))))." quadrillion";
								  if ($number % pow(10, 15))
								   $suffix = Convert::engFormat($number % pow(10, 15));
								  $string = $prefix." ".$suffix;
								  break;
						}
		   }
			return $string;					  
	}
  
	function numtotext($number,$lang="th"){ 
			$message = "";
			if($lang == "en"){
					$thb = $number;
				   list($thb, $ths) = explode('.', $thb);
				   $ths = substr($ths.'00', 0, 2);
				   $thb = Convert::engFormat(intval($thb)).' Baht';
				   if (intval($ths) > 0) {
						$thb .= ' '.Convert::engFormat(intval($ths)).' Satang';
				   }
				   $message = $thb;				
			}else{
					$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
					$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
					$number = str_replace(",","",$number); 
					$number = str_replace(" ","",$number); 
					$number = str_replace("บาท","",$number); 
					$number = explode(".",$number); 
					if(sizeof($number)>2){ 
					return 'ทศนิยมหลายตัวนะจ๊ะ'; 
					exit; 
					} 
					$strlen = strlen($number[0]); 
					$convert = ''; 
					for($i=0;$i<$strlen;$i++){ 
						$n = substr($number[0], $i,1); 
						if($n!=0){ 
							if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
							elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
							elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
							else{ $convert .= $txtnum1[$n]; } 
							$convert .= $txtnum2[$strlen-$i-1]; 
						} 
					} 

					$convert .= 'บาท'; 
					if($number[1]=='0' OR $number[1]=='00' OR 
					$number[1]==''){ 
						$convert .= 'ถ้วน'; 
					}else{ 
						$strlen = strlen($number[1]); 
						for($i=0;$i<$strlen;$i++){ 
						$n = substr($number[1], $i,1); 
							if($n!=0){ 
							if($i==($strlen-1) AND $n==1){$convert 
							.= 'เอ็ด';} 
							elseif($i==($strlen-2) AND 
							$n==2){$convert .= 'ยี่';} 
							elseif($i==($strlen-2) AND 
							$n==1){$convert .= '';} 
							else{ $convert .= $txtnum1[$n];} 
							$convert .= $txtnum2[$strlen-$i-1]; 
							} 
						} 
						$convert .= 'สตางค์'; 
					} 
					$message = $convert; 
			}
			return $message;
	} 	
	
	function truncate($value,$min, $limit = 100, $end = '...')
	{
		$value = preg_replace("/[\n\r]/","",$value); 
		$value = str_pad($value, $min);   
		if (mb_strwidth($value, 'UTF-8') <= $limit) {
			return $value;
		}

		return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
	}	
	
}//end class
?>