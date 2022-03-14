<?php
require("../utils/request.php");
session_start(); // Starting Session

function sendResponse($response){
    echo json_encode($response);
}

function nuevo($request){
    require("../models/comentario.php");      
     	
		$c = new Comentario();
		
		 $nuevo = $c->create(array(
            "user_id" => $request->user_id,
            "nota_id" =>  $request->nota_id,
			"descripcion"  =>  $request->descripcion
        ));
		 
        if ($nuevo){                 
				sendResponse(array(
					"error" => false,
					"mensaje" => "comentario creado",
					"data" => $nuevo
				));
		}else{
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error al crear comentario"
			));
		}		
		
}

function actualizar($request){
    require("../models/comentario.php");
    $comentario = array();		 
    
    $comentario["id"] = $request->id;
    $comentario["user_id"] = $request->user_id;
    $comentario["nota_id"] =  $request->nota_id;
	$comentario["descripcion"]  =  $request->descripcion;
	$comentario["estadoItem_id"]  =  $request->estadoItem_id;
  
    
	$c = new Comentario();
    if($c->update($comentario)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "comentario actualizado"
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al actualizar comentario"
        ));
    }
    
}

function eliminar($request){
    
    require("../models/comentario.php");
    $c = new Comentario();
    if($c->remove($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "comentario eliminado"
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al eliminar comentario"
        ));
    }
    
}

function eliminarView($request){
    
    require("../models/comentario.php");
    $c = new Comentario();
    if($c->removeView($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "comentario view eliminado"
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al eliminar view comentario"
        ));
    }
    
}


function listarPorIdNota($request){
    require("../models/comentario.php");
    $c = new Comentario();
    if($comentarios = $c->getPorIdNota($request->idNota)){
    
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $comentarios
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener comentarios"
        ));
    }
}

function listar($request){
    require("../models/comentario.php");
    $c = new Comentario();
    if($comentarios = $c->getAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $comentarios
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener comentarios"
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
     case "listarPorIdNota":
        listarPorIdNota($request);
        break;
    case "eliminar":
        eliminar($request);
        break;
	case "eliminarView":
        eliminarView($request);
        break;
   
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formada"
        ));
        break;
}