<?php

require("../utils/request.php");

function sendResponse($response){
    echo json_encode($response);
}



function nueva($request){
    require("../models/lectura.php");	      
		/*if (true){
			sendResponse(array(
					"error" => false,
					"mensaje" => "lectura creado",
					"data" => $request
				));
		
		}*/
		/*else {*/
		$n = new Lectura();
		
		 $nueva = $n->create(array(
			"user_id" => $request->user_id,        
			"nota_id"  =>  $request->nota_id			
		));
            
        
		 if ($nueva){	
				sendResponse(array(
					"error" => false,
					"mensaje" => "lectura creado",
					"data" => $nueva
				));
			
		}else{
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error al crear lectura"
			));
		}		
		
   
		/*  } */ 	
   
}

function actualizar($request){
    require("../models/lectura.php");
	 $lectura = array();	
	    
    $lectura["id"] = $request->id;
    $lectura["user_id"] = $request->user_id;    
    $lectura["nota_id"] = $request->nota_id;    
    
	$n = new Lectura();
    if($n->update($lectura)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "lectura actualizada"
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al actualizar lectura"
        ));
    }
}

function eliminar($request){
    require("../models/lectura.php");
    $n = new Lectura();
    if($n->remove($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "lectura eliminada"
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error ..."
        ));
    }
}




function listar($request){
    require("../models/lectura.php");
    $n = new Lectura();
    if($lecturas = $n->get($request->lectura_id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $lecturas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener un lectura"
        ));
    }
}

function listarPorIdNotaIdUser($request){
    require("../models/lectura.php");
    $n = new Lectura();
    if($lecturas = $n->getPorIdNotaIdUser($request->nota_id,$request->user_id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $lecturas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => $request
        ));
    }
}



function listarAll(){
    require("../models/lectura.php");
    $n = new Lectura();
    if($lecturas = $n->getAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $lecturas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener los lecturas"
        ));
    }
}

$request = new Request();
$action = $request->action;
switch($action){
    case "guardar":
        nueva($request);
        break;   
    case "actualizar":
        actualizar($request);
        break;
    case "listar":
        listar($request);
        break; 
	case "listarPorIdNotaIdUser":
        listarPorIdNotaIdUser($request);
        break; 		
    case "listarAll":
        listarAll();
        break;	
    case "eliminar":
        eliminar($request);
        break;
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formadoo"
        ));
        break;
}
