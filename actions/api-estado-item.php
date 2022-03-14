<?php

require("../utils/request.php");

function sendResponse($response){
    echo json_encode($response);
}



function listar($request){
    require("../models/estado-item.php");
    $n = new EstadoItem();
    if($estadosItems = $n->get($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $estadosItems
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener un estado item"
        ));
    }
}

function listarAll(){
    require("../models/estado-item.php");
    $n = new EstadoItem();
    if($estadosItems = $n->getAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $estadosItems
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener los estados items"
        ));
    }
}

$request = new Request();
$action = $request->action;
switch($action){
     case "listar":
        listar($request);
        break; 
    case "listarAll":
        listarAll();
        break;	 
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formade"
        ));
        break;
}
