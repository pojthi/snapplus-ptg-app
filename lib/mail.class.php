<?php
date_default_timezone_set('Asia/Bangkok');
require_once('../../plugin/phpmailer/PHPMailerAutoload.php');

class Mail{
	 public $mail;
	 
	 public function __construct() {
			$this->mail = new PHPMailer();
			$this->mail->isSMTP();
			$this->mail->SMTPAuth = true;
			$this->mail->SMTPSecure = "SSL";
			$this->mail->Host = "smtp.gmail.com"; // ถ้าใช้ smtp ของ server เป็นอยู่ในรูปแบบนี้ mail.domainyour.com
			$this->mail->Port = 587;
			$this->mail->isHTML();
			$this->mail->CharSet = "utf-8"; //ตั้งเป็น UTF-8 เพื่อให้อ่านภาษาไทยได้
			$this->mail->Username = "support@teslabimx.com"; //กรอก Email Gmail หรือ เมลล์ที่สร้างบน server ของคุณเ
			$this->mail->Password = "Support123456"; // ใส่รหัสผ่าน email ของคุณ		
			
			$this->mail->SetFrom = ('support@teslabimx.com'); //กำหนด email เพื่อใช้เป็นเมล์อ้างอิงในการส่ง
			$this->mail->FromName = "Support Tesla Bim-X"; //ชื่อที่ใช้ในการส่ง			
	 }
 

	public function Subject($text){	
		$this->mail->Subject = $text;  //หัวเรื่อง emal ที่ส่ง
	}
	public function Body($text){	
		$this->mail->Body = $text;  //หัวเรื่อง emal ที่ส่ง
	}	
	public function AddAddress($email){	
		$this->mail->AddAddress($email);  //หัวเรื่อง emal ที่ส่ง
	}
	public function AddCC($email){				
		$this->mail->AddCC($email); // to email
	}  
	public function AddBCC($email){				
		$this->mail->AddBCC($email); // to email
	} 		  

	public function Send($to = "",$subject = "",$message = "",$attachname="",$attachurl = ""){								
		if($subject != ""){
			$this->mail->Subject = $subject;
		}
		if($message != ""){
			$this->mail->Body =$message;	
		}		
		if($to != ""){
			$this->mail->AddAddress($to); // to Address
		}
		if($attachname != ""){						
			$this->mail->AddAttachment( $attachurl , $attachname);					
		}		
		return $this->mail->Send(); // true/false		
	}  
	  
	//$this->mail->Subject = "ทดสอบการส่งอีเมล์";  //หัวเรื่อง emal ที่ส่ง
	//$this->mail->Body = "ทดสอบส่งเมลล์ในส่วนของรายละเอียดเนื้อหา</b>"; //รายละเอียดที่ส่ง
	//$this->mail->AddAddress('mrkratai@gmail.com'); //อีเมล์และชื่อผู้รับ
	
	//ส่วนของการแนบไฟล์ รองรับ .rar , .jpg , png
	//$this->mail->AddAttachment("files/1.rar");
	//$this->mail->AddAttachment("files/1.png");
	
	//public function Add($email){				
	//	$this->mail->AddAddress($email); // to email
	//} 

	//public function Send($to,$subject,$message){				
	//	$this->mail->Subject = $subject;
	//	$this->mail->Body =$message;		
	//	if($to != ""){
	//			$this->mail->AddAddress($to); // to Address
	//	}				
	//	return $this->mail->Send(); 		
	//}  
	
}//end class

?>