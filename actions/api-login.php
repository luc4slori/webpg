<?php
session_start();
require("../utils/request.php");
require("../models/user.php");


function sendResponse($response){
    echo json_encode($response);
	exit;
}


function check($request){
    if (isset($_SESSION['id'])){
        sendResponse(array(
            "error" => false,
            "mensaje" => "esta logueado",
            "data" => $_SESSION
        ));
    }
    else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "NO esta logueado"            
        ));
    }
        
}

function logout($request){
    if(session_destroy()){ // Destroying All Sessions   
        //unset($_SESSION['id']);
        sendResponse(array(
            "error" => false,
            "mensaje" => "logout satisfactorio",
            "data" => $_SESSION
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al hacer logout"
        ));
    }
}

function login($request){    
	
	
    $email = $request->email;
	$passw = $request->passw;
	$belong = $request->belong;
	
	 
	
	if ($email==null || $passw==null){
		sendResponse(array(
				"error" => true,
				"mensaje" => "* Los campos no pueden ser nulos"
			));
	}
	else{
		$user = array();
		$s = new User();	
		$user = $s->getLogin($email, md5($passw), $belong);
	
		if ($user==null){
			sendResponse(array(
				"error" => true,
				"mensaje" => "* Error al loguearse"
			));
		}else{            
			$_SESSION['id']=$user['id'];            
			$_SESSION['nombre']=$user['nombre'];
			$_SESSION['apellido']=$user['apellido'];
			$_SESSION['email']=$user['email'];
			$_SESSION['tipo']=$user['tipo'];
			$_SESSION['belong']=$user['belong'];
			
			if ($_SESSION['estado']=$user['estado']!='activa'){
				sendResponse(array(
					"error" => true,
					"mensaje" => "* Tu cuenta se encuentra ".$user['estado']				
				));
			} 
			else {			
				sendResponse(array(
					"error" => false,
					"mensaje" => "bien",
					"data" => $_SESSION
				));
			}
		}
	}
}

$request = new Request();
$action = $request->action;
switch($action){
    case "check":
        check($request);
        break; 
    case "login":
        login($request);
        break;   
    case "logout":
        logout($request);
        break;
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formadi"
        ));
        break;
}