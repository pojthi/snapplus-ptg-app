<?php

class Encryption
{	
	var $key = "xxxx";
	var $iv = 'xxxxx.com';

	  /*
	  public function Encrypt($string)
	  {
			$hash = password_hash($string, PASSWORD_DEFAULT);
			return $hash ;
	  }
	*/
	
	function encurl($para,$hash){
			return base64_encode($para.$hash);
	}
	
	function decurl($url,$hash){
			$code =  base64_decode($url);
			return str_replace($hash,'',$code);
	}		
	
	  public function Verify($string,$hash)
	  {	  
			return password_verify($string, $hash); //Returns true
	  }
	  
	  
		function Encode( $string) {				
			$output = "";
			$encrypt_method = "AES-256-CBC";
			$secu_key = hash( 'sha256', $this->key );
			$secu_iv = substr( hash( 'sha256', $this->iv ), 0, 16 );
		 
			$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $secu_key , 0, $secu_iv ) );
			return $output;
		}

		function Decode( $string) {					 
			$output = "";
			$encrypt_method = "AES-256-CBC";
			$secu_key = hash( 'sha256', $this->key );
			$secu_iv = substr( hash( 'sha256', $this->iv ), 0, 16 );
		 
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $secu_key, 0, $secu_iv );
			return $output;
		}		
		
		function Random($length = 8) {
			//return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
			return substr(sha1(time()), 0, $length); 
		}
		
}
?>