<?php
	date_default_timezone_set('Asia/Bangkok');
	require_once('../plugins/mail/phpmailer.class.php');
	
	class Mail{
		 public $mail;
		 
		  public function __construct() {
				$this->mail = new PHPMailer();
				$this->mail->CharSet = "utf-8";
				$this->mail->IsHTML(true);
				$this->mail->IsSMTP();
				$this->mail->SMTPAuth = true; // enable SMTP authentication
				$this->mail->SMTPSecure = ""; // sets the prefix to the servier
				$this->mail->Host = "mail.teslabim.co.th"; // sets GMAIL as the SMTP server
				$this->mail->Port = 587; // set the SMTP port for the GMAIL server
				$this->mail->Username = "admin@teslabim.co.th"; // GMAIL username
				$this->mail->Password = "0805996604"; // GMAIL password
				$this->mail->From = "admin@teslabim.co.th"; // "name@yourdomain.com";				
				//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
				$this->mail->FromName = "Tesla BIM X";  // set from Name					
		  }
		  
		  public function Add($email){				
				$this->mail->AddAddress($email); // to email
		  } 		  
		  
		  public function AddCC($email){				
				$this->mail->AddCC($email); // to email
		  }  

		  public function AddBCC($email){				
				$this->mail->AddBCC($email); // to email
		  } 	
		  
		  public function Send($to,$subject,$message,$attachname="",$attachurl = ""){				
				$this->mail->Subject = $subject;
				$this->mail->Body =$message;				
				$this->mail->AddAddress($to); // to Address
				//$this->mail->AddBCC("petchpilai@teslabim.co.th", "petchpilai");		
				if($attachname != ""){						
						$this->mail->AddAttachment( $attachurl , $attachname);					
				}
				$this->mail->Send(); 	
		  }  	 		  
		  			

	  
		  		  
		  

	}	
	
?>


  