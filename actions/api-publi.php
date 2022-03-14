<?php

require("../utils/request.php");

function sendResponse($response){
    echo json_encode($response);
}


function guardarArchivo($file, $publiId){
    $uploaddir = "../files/publi/";
    $publiDir = $uploaddir . $publiId;
	if (!file_exists($publiDir)) {
		if(!mkdir($publiDir, 0777, true)){
			return false;
		}
	}	
	
	
	//$file_name = utf8_decode ($file['name']);
	$file_name = $file['name'];
	
	return move_uploaded_file($file['tmp_name'], $publiDir . "/" . $file_name); 
  }


function nueva($request){
    require("../models/publi.php");	
       
     if(!empty($_FILES)){    
                
        $publiFile = $_FILES[0];		
		$n = new Publi();
		
		 $nueva = $n->create(array(            
			"pathFoto"  =>  $request->pathFoto,
            "menu_id" =>  $request->menu_id,
			"href" =>  $request->href,
			"estadoItem_id" =>  $request->estadoItem_id,			
			"filenameFoto"  =>  $publiFile['name']
        ));
            
        
		 if ($nueva){	
			if(guardarArchivo($publiFile, $nueva['id'])){						
				sendResponse(array(
					"error" => false,
					"mensaje" => "publi creado",
					"data" => $nueva
				));
			}else{
				sendResponse(array(
					"error" => true,
					"mensaje" => "error al guardar publi"					
				));
			}
			
		}else{
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error al crear publi"
			));
		}		
		
    }else{
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error falta seleccionar imagen"
			));
    }
		   	
   
}


function publicidadRepositorio($request){
    require("../models/publi.php");
	 $publi = array();

    $publi["id"] = $request->id;	
    
	$n = new Publi();
    if($n->publicidadRepositorio($publi)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "publi al repositorio"
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al mandar al repositorio"
        ));
    }
}


function updateEstadov2($request){
    require("../models/publi.php");
	 $publi = array();
	$publi["id"] = $request->id;	
    $publi["lugarPubli"] = $request->lugarPubli;
	$publi["href"] = $request->href;
	$publi["pathFoto"] = $request->pathFoto;
	$publi["timePopup"] = $request->timePopup;	
	$publi["menu_id"] = $request->menu_id;
	   
	if(!empty($_FILES)){    
        $publiFile = $_FILES[0];			
		$publi["filenameFoto"]= $publiFile['name'];
        guardarArchivo($publiFile, $publi['id']);
    }else{	
		$publi["filenameFoto"]= $request->filenameFoto;
	}   
	
	$n = new Publi();
    if($n->updateEstadov2($publi)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "publi actualizada",
				"data" => $publi
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al actualizar publi"
        ));
    }
}
/*
function cambiarEstado($request){
    require("../models/publi.php");
	 $publi = array();

    $publi["id"] = $request->id;
	$publi["menu_id"] = $request->menu_id;
    $publi["estadoItem_id"] = $request->estadoItem_id;
    
	$n = new Publi();
    if($n->updateEstado($publi)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "publi actualizada"
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al actualizar publi"
        ));
    }
}
*/

function actualizar($request){
    require("../models/publi.php");
	 $publi = array();
	 $publiFile=null;
	 
    //$publi["menu_id"] = $request->menu_id;
    $publi["id"] = $request->id;
    $publi["href"] = $request->href;    
    $publi["pathFoto"] = $request->pathFoto;
    $publi["estadoItem_id"] = $request->estadoItem_id;
    
    if(!empty($_FILES)){    
        $publiFile = $_FILES[0];			
		$publi["filenameFoto"]= $publiFile['name'];
        guardarArchivo($publiFile, $publi['id']);
    }else{	
		$publi["filenameFoto"]= $request->filenameFoto;
	}
	
    
	$n = new Publi();
    if($n->update($publi)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "publi actualizada"
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al actualizar publi"
        ));
    }
}

function eliminar($request){
    require("../models/publi.php");
    $n = new Publi();
    if($n->remove($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "publi eliminada"
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error ..."
        ));
    }
}

function listar($request){
    require("../models/publi.php");
    $n = new Publi();
    if($publis = $n->get($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $publis
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener publis"
        ));
    }
}

function listarAll($request){
    require("../models/publi.php");
    $n = new Publi();
    if($publis = $n->getAll($request->menu_id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $publis
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener publis"
        ));
    }
}

function getPubliv2Index($request){
    require("../models/publi.php");
    $n = new Publi();
    if($publis = $n->getPubliv2Index($request->offset)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $publis
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener publis"
        ));
    }
}

function listarAllAll(){
    require("../models/publi.php");
    $n = new Publi();
    if($publis = $n->getAllAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $publis
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener publis"
        ));
    }
}

/*inactivo por ahora*/ 
function getBannersHeader(){
    require("../models/publi.php");
    $n = new Publi();
    if($publis = $n->getBannersHeader()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $publis
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener publis"
        ));
    }
}

function listarAllAllAdmin(){
    require("../models/publi.php");
    $n = new Publi();
    if($publis = $n->getAllAllAdmin()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $publis
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener publis"
        ));
    }
}

function getPopup(){
    require("../models/publi.php");
    $n = new Publi();
    if($popup = $n->getPopup()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $popup
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener popup"
        ));
    }
}

function getFooterPubli(){
    require("../models/publi.php");
    $n = new Publi();
    if($footer = $n->getFooterPubli()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $footer
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener footer"
        ));
    }
}

function getHeaderPubli(){
    require("../models/publi.php");
    $n = new Publi();
    if($header = $n->getHeaderPubli()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $header
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener header"
        ));
    }
}

function getPubliEnNota(){
    require("../models/publi.php");
    $n = new Publi();
    if($header = $n->getPubliEnNota()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $header
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener header"
        ));
    }
}

function getDelay(){
    require("../models/publi.php");
    $n = new Publi();
    if($delay = $n->getDelay()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $delay
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener delay"
        ));
    }
}

function setDelay($request){
    require("../models/publi.php");
    $n = new Publi();
    if($n->setDelay($request->timePopup)){
        sendResponse(array(
            "error" => false,
            "mensaje" => ""
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener delay"
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
    case "listarAll":
        listarAll($request);
        break; 
    case "listarAllAll":
        listarAllAll();
        break;	
	case "listarAllAllAdmin":
        listarAllAllAdmin();
        break;		
	case "getBannersHeader":
        getBannersHeader();
        break;			
    case "eliminar":
        eliminar($request);
        break;
	/*
	case "cambiarEstado":
        cambiarEstado($request);
        break;
	*/
	case "updateEstadov2":
        updateEstadov2($request);
        break;	
	case "publicidadRepositorio":
        publicidadRepositorio($request);
        break;	
	case "getPopup":
        getPopup();
        break;	
	case "getHeaderPubli":
        getHeaderPubli();
        break;	
	case "getFooterPubli":
        getFooterPubli();
        break;	
	case "getPubliEnNota":
        getPubliEnNota();
        break;		
	case "getDelay":
        getDelay();
        break;	
	case "setDelay":
        setDelay($request);
        break;
	case "getPubliv2Index":
        getPubliv2Index($request);
        break;
	
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formadu"
        ));
        break;
}
