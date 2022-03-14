<?php

require("../utils/request.php");

function sendResponse($response){
    echo json_encode($response);
}


function listarAllAllAll(){
    require("../models/gallery.php");
    $n = new Gallery();
    if($gallerys = $n->getAllAllAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $gallerys
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener gallerys"
        ));
    }
}

function listarAllAll($request){
    require("../models/gallery.php");
    $n = new Gallery();
    if($gallerys = $n->getAllAll($request->menu)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $gallerys
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener gallerys"
        ));
    }
}

function listarAll($request){
    require("../models/gallery.php");
    $n = new Gallery();
    if($gallerys = $n->getAll($request->submenu)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $gallerys
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener gallerys"
        ));
    }
}


$request = new Request();
$action = $request->action;
switch($action){
     
    case "listarAll":
        listarAll($request);
        break;
   case "listarAllAll":
        listarAllAll($request);
        break;
    case "listarAllAllAll":
        listarAllAllAll();
        break;
   
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formadu"
        ));
        break;
}
