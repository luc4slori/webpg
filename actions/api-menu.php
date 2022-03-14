<?php

require("../utils/request.php");

function sendResponse($response){
    echo json_encode($response);
}

function guardarArchivo($file, $menuId){
    $uploaddir = "../files/menu/";
    $menuDir = $uploaddir . $menuId;
	if (!file_exists($menuDir)) {
		if(!mkdir($menuDir, 0777, true)){
			return false;
		}
	}	
	
	//$file_name = utf8_decode ($file['name']);
	$file_name = $file['name'];
	
	return move_uploaded_file($file['tmp_name'], $menuDir . "/" . $file_name); 
  }

function nueva($request){
    require("../models/menu.php");	
       
     if(!empty($_FILES)){    
                
        $menuFile = $_FILES[0];		
		$n = new Menu();
		
		 $nueva = $n->create(array(
			"titulo" => $request->titulo,        
			"pathFoto"  =>  $request->pathFoto,
			"filenameFoto"  =>  $menuFile['name'],
			"estadoItem_id" => $request->estadoItem_id
        ));
            
        
		 if ($nueva){	
			if(guardarArchivo($menuFile, $nueva['id'])){						
				sendResponse(array(
					"error" => false,
					"mensaje" => "menu creado",
					"data" => $nueva
				));
			}else{
				sendResponse(array(
					"error" => true,
					"mensaje" => "error al guardar archivo del menu"					
				));
			}
			
		}else{
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error al crear menu"
			));
		}		
		
    }else{
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error falta seleccionar imagen"
			));
    }
		   	
   
}

		

function actualizar($request){
    require("../models/menu.php");
	 $menu = array();
	 $menuFile=null;
	    
    $menu["id"] = $request->id;
    $menu["titulo"] = $request->titulo;    
    $menu["pathFoto"] = $request->pathFoto;
    $menu["estadoItem_id"] = $request->estadoItem_id;
    
    if(!empty($_FILES)){    
        $menuFile = $_FILES[0];			
		$menu["filenameFoto"]= $menuFile['name'];
        guardarArchivo($menuFile, $menu['id']);
    }else{	
		$menu["filenameFoto"]= $request->filenameFoto;
	}
	
    
	$n = new Menu();
    if($n->update($menu)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "menu actualizada"
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al actualizar menu"
        ));
    }
}

function eliminar($request){
    require("../models/menu.php");
    $n = new Menu();
    if($n->remove($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "menu eliminada"
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error ..."
        ));
    }
}


function listarMedioIndex(){
    require("../models/menu.php");
    $n = new Menu();
    if($menus = $n->getMedioIndex()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $menus
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener un medioIndex"
        ));
    }
}


function listar($request){
    require("../models/menu.php");
    $n = new Menu();
    if($menus = $n->get($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $menus
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener un menu"
        ));
    }
}

function listarOtros($request){
    require("../models/menu.php");
    $n = new Menu();
    if($menus = $n->getOtros($request->id_actual)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $menus
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener los otros"
        ));
    }
}

function listarAll(){
    require("../models/menu.php");
    $n = new Menu();
    if($menus = $n->getAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $menus
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener los menus"
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
	case "listarOtros":
        listarOtros($request);
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
