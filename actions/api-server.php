<?php
require("../utils/request.php");
session_start(); // Starting Session

function sendResponse($response){
    echo json_encode($response);
}

function setCurrentURL($request){
 
	$_SESSION['currentURL'] = $request->url_actual;
	$_SESSION['comentarioActual'] = $request->comentario_actual;
	
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $_SESSION
        ));
  
}

function getTipoUser(){ 
	if(!isset($_SESSION['tipo'])){
		$_SESSION['tipo'] = "user";
	}
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $_SESSION['tipo']
        ));
  
}

function sendMailSualf($request){
 
 $to = "osnaraus@gmail.com, matiasezequielalfano@gmail.com";
 //$to = "osnaraus@gmail.com";
 $subject = "Tenemos Laburo !";
 $txt = "nombre: ".$request->nombre . "\r\n email:  ".$request->email . "\r\n comentario:".$request->comments;
 
 //$headers = "From: proyectogeo@proyectogeo.com" . "\r\n" ."CC: somebodyelse@example.com";
 $headers = "From: proyectogeo@proyectogeo.com";
 

	if (!mail($to,$subject,$txt,$headers)){
		return false;
	}else{
		return true;
	}
 }
 
 function sendMailSubscribe($email){
 
 $to = "osnaraus@gmail.com, matiasezequielalfano@gmail.com"; 
 $subject = "Desde Viejos Son Los Trapos";
 $txt = "email:  ".$email;
 
 $headers = "From: proyectogeo@proyectogeo.com";
 

	if (!mail($to,$subject,$txt,$headers)){
		return false;
	}else{
		return true;
	}
 }

function contactSualf($request){    	
	
    $gresponse = $request->{'g-recaptcha-response'};
	$apenom = $request->nombre;
	$telefono = $request->email;	
	$comments = $request->comments;	
	
	$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfIVAoUAAAAACTBsjZAxZPa2mtVhybx9pI0khVz&response=".$gresponse),true);
	
	if($response['success'] == false) {		
			sendResponse(array(
				"error" => true,
				"mensaje" => "Verifica que sos un humano"	
			));
	} else {
		if (sendMailSualf($request)){
				sendResponse(array(
					"error" => false				
				));
		} else {
				sendResponse(array(
					"error" => true,
					"mensaje" => "Error al enviar email"	
			));
		}
	}
		
		
	
}	

function subscribe($request){    	
	
    
	
	$email = $request->email;	
	
	if (sendMailSubscribe($email)){
			sendResponse(array(
				"error" => false				
			));
		} else {
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error al enviar email"	
			));
		}
		
	
}	

$request = new Request();
$action = $request->action;
switch($action){
    case "setCurrentURL":
        setCurrentURL($request);
        break;
    case "getTipoUser":
        getTipoUser();
        break;
	case "sendMailSualf":
		sendMailSualf($request);
        break;
	case "contactSualf":
		contactSualf($request);
		break;
	case "subscribe":
		subscribe($request);
		break;
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formadoo"
        ));
        break;
}
