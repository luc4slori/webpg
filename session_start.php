<?php ob_start();
@session_start();
$id = null;
//$rootDir   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rootDir = "";
if(isset($_SESSION['id'])){
	$id= $_SESSION['id'];
	$nombre= $_SESSION['nombre'];
	$apellido= $_SESSION['apellido']; 
	$tipo= $_SESSION['tipo']; 
	$email= $_SESSION['email']; 
	$belong= $_SESSION['belong']; 
	
} else{
	if(isset($_SESSION['status']) && $_SESSION['status']=='verified') {
		//Success, redirected back from process.php with varified status.
		//retrive variables
		$nombreTwt				= $_SESSION['request_vars']['screen_name'];
		$emailTwt				= $_SESSION['request_vars']['user_id'];
		$oauth_token 		= $_SESSION['request_vars']['oauth_token'];
		$oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];		 	
		//$picTwt 		= $_SESSION['imgTwt'] = 'https://twitter.com/'.$nombreTwt.'/profile_image'; 
		$picTwt 		= $_SESSION['imgTwt'] ;
	} else {
		
	}
} 


include_once("models/config.php");
include_once("models/inc/twitteroauth.php");
?>