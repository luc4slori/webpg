<?php
require("../utils/request.php");
session_start(); // Starting Session

function sendResponse($response){
    echo json_encode($response);
}

function buildFolder($user){
	$uploaddir = "../files/usr/";
    $usrDir = $uploaddir . $user['id'];
	if (!file_exists($usrDir)) {
		$oldmask = umask(0);
		if(!mkdir($usrDir, 0777, true)){
			return false;
		}
		umask($oldmask);
	}
	
	$img = $usrDir.'/'.'avatar.jpg';
	file_put_contents($img, file_get_contents($user['imagen']));
	chmod( $img, 0666);
	$_SESSION['id']=$user['id'];            
	$_SESSION['nombre']=$user['nombre'];
	$_SESSION['apellido']=$user['apellido'];
	$_SESSION['email']=$user['email'];
	$_SESSION['imagen']=  substr($img, 3);
	$_SESSION['belong']= $user['belong'];
	$_SESSION['tipo']= $user['tipo'];
	return true;
	
}

function logSocial($request){

	require("../models/user.php");
	$s = new User();	
	
	if($user = $s->getEmail($request->email,$request->belong)){	
		//update
		$user['imagen']=$request->imgSrc;
		if (buildFolder($user)){
			$user['imagenLocal']= $_SESSION['imagen'];
			sendResponse(array(
								"error" => false,
								"mensaje" => "user social logueado",
								"data" => $user
							));
		} else {	
			sendResponse(array(
							"error" => true,
							"mensaje" => "error en buildfolder"
							
						));
		}
	}else{
		//insert
		$hash = md5(uniqid(rand(), true));
		$telefono = !empty($request->telefono) ? $request->telefono : 'NO';
		$fechanac = !empty($request->fechanac) ? $request->fechanac : '1912-12-12';
		$user = $s->create(array(			
			"nombre" => $request->nombre,
			"apellido" =>  $request->apellido,
			"passw"  => $hash,
			"email"  => $request->email,
			"telefono"  => $telefono,		
			"fechanac"  => $fechanac,
			"hash" => $hash,
			"imagen"  => $request->imgSrc,
			"deseo"  => "1",
			"belong" => $request->belong,
			"tipo" => 'user' //solamente se usa para enviar a buildFolder, no entra en el create
			));
		if (!$user){			
			sendResponse(array(
						"error" => true,
						"mensaje" => "user social NO creado"					
					));
		} else {
			if (buildFolder($user)){
			$user['imagenLocal']= $_SESSION['imagen'];
				sendResponse(array(
								"error" => false,
								"mensaje" => "user social creado",
								"data" => $user
							));		
			} else {
				sendResponse(array(
						"error" => true,
						"mensaje" => "buildFolder NO creado"					
					));
			}
		}
			
	}
	
}



function nuevo($request){
    require("../models/user.php");      		
		
		$s = new User();
		
		if($emailActivated = $s->getEmail($request->email, $request->belong)){
			sendResponse(array(
			    "error" => true,
			    "mensaje" => "El e-mail ya esta registrado",
			    "data" => $emailActivated
			));
		}else{
			if (!$deseo=$request->deseo){
				$deseo=false;
			}
	
			if (!$imagen=$request->imagen){
				$imagen="";		
			}
			
			$hash = md5(uniqid(rand(), true));
			$belong = "";
			$telefono = !empty($request->telefono) ? $request->telefono : 'NO';
			$fechanac = !empty($request->fechanac) ? $request->fechanac : '1912-12-12';
			
			$nuevo = $s->create(array(
	
			"nombre" => $request->nombre,
			"apellido" =>  $request->apellido,
			"passw"  => md5($request->passw),
			"email"  => $request->email,
			"telefono"  => $telefono,		
			"fechanac"  => $fechanac,
			"hash" => $hash,
			"imagen"  => $imagen,
			"deseo"  => $deseo,
			"belong" => $belong
			));
			 
			if ($nuevo){
				
				$message = " Para activar su cuenta haga click en el siguiente link:\n\n";
				$message .= 'http://madalf.com.ar/activate.php?email=' . urlencode($nuevo['email']) . "&key=$hash";
				if (!mail($nuevo["email"], 'Confirmacion de Registracion - ProyectoGeo', $message)){
					sendResponse(array(
						"error" => true,
						"mensaje" => "Error al enviar el mail",
						"data" => ""
					));
				}
				else{
					sendResponse(array(
						"error" => false,
						"mensaje" => "user creado",
						"data" => $nuevo
					));
				}
			}else{
				sendResponse(array(
					"error" => true,
					"mensaje" => "Error al crear user"
				));
			}		
		}
}

function actualizar($request){
    require("../models/user.php");
	 $user = array();
	
	if (!$deseo=$request->deseo){
			$deseo=false;
	}
		
	if($emailActivated = $s->getEmail($request->email, $request->belong)){
			sendResponse(array(
			    "error" => true,
			    "mensaje" => "",
			    "data" => $emailActivated
			));
	}else{
		$user["id"] = $request->id;
		$user["nombre"] = $request->nombre;
		$user["apellido"] = $request->apellido;
		$user["telefono"] = $request->telefono;    
		$user["passw"] = md5($request->passw);
		$user["email"] = $request->email;
		$user["fechanac"] = $request->fechanac;
		$user["deseo"] = $deseo;
		/* imagen no se actualiza $user["imagen"] = $request->imagen;*/
		/*hash no se actualiza*/
		  
    
		$s = new User();
		if($s->update($user)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "user actualizado"
			));
		}else{
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error al actualizar user"
			));
		}
	}
}

function eliminar($request){
    require("../models/user.php");
    $s = new User();
    if($s->remove($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "user eliminado"
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error ..."
        ));
    }
}

function listar($request){
    require("../models/user.php");
    $s = new User();
    if($users = $s->getAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $users
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener users"
        ));
    }
}

$request = new Request();
$action = $request->action;
switch($action){
    case "guardar":
        nuevo($request);
        break;   
    case "actualizar":
        actualizar($request);
        break;
    case "listar":
        listar($request);
        break;   
    case "eliminar":
        eliminar($request);
        break;
	 case "logSocial":
        logSocial($request);
        break;		
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formadaa"
        ));
        break;
}