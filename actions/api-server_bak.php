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
 $subject = "Tenemos Laburo !";
 $txt = "nombre: ".$request->nombre . "\r\n email:  ".$request->email . "\r\n comentario:".$request->comments;
 
 //$headers = "From: proyectogeo@proyectogeo.com" . "\r\n" ."CC: somebodyelse@example.com";
 $headers = "From: proyectogeo@proyectogeo.com";
 

	if (!mail($to,$subject,$txt,$headers)){
		sendResponse(array(
			"error" => true,
			"mensaje" => "Error al enviar el mail"
		));
	}else{
		sendResponse(array(
			"error" => false,
			"mensaje" => "Mail Enviado"			
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
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formadoo"
        ));
        break;
}
