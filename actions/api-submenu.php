<?php

require("../utils/request.php");

function sendResponse($response){
    echo json_encode($response);
}


function guardarArchivo($file, $submenuId){
    $uploaddir = "../files/submenu/";
    $submenuDir = $uploaddir . $submenuId;
	if (!file_exists($submenuDir)) {
		if(!mkdir($submenuDir, 0777, true)){
			return false;
		}
	}	
	$file_name = $file['name'];
	
	return move_uploaded_file($file['tmp_name'], $submenuDir . "/" . $file_name);  
  }



function nueva($request){
    require("../models/submenu.php");	
       
     if(!empty($_FILES)){    
                
        $submenuFile = $_FILES[0];		
		$n = new Submenu();
		
		 $nueva = $n->create(array(
			"titulo" => $request->titulo,           
			"descripcion" =>  $request->descripcion,
			"pathFoto"  =>  $request->pathFoto,
			"menu_id" =>  $request->menu_id,			
			"portada" =>  $request->portada,
			"word" =>  $request->word,
			"filenameFoto"  =>  $submenuFile['name'],
			"fecha"  =>  $submenuFile['fecha'],
			"visitas"  =>  $submenuFile['visitas'],
			"estadoItem_id" => $request->estadoItem_id
		));
            
        
		 if ($nueva){	
			if(guardarArchivo($submenuFile, $nueva['id'])){						
				sendResponse(array(
					"error" => false,
					"mensaje" => "submenu creado",
					"data" => $nueva
				));
			}else{
				sendResponse(array(
					"error" => true,
					"mensaje" => "error al guardar submenu"					
				));
			}
			
		}else{
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error al crear submenu"
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
    require("../models/submenu.php");
	 $submenu = array();
	 $submenuFile=null;
	 
    $submenu["menu_id"] = $request->menu_id;
    $submenu["id"] = $request->id;
    $submenu["titulo"] = $request->titulo;
    $submenu["descripcion"] = $request->descripcion;
    $submenu["pathFoto"] = $request->pathFoto;
    $submenu["estadoItem_id"] = $request->estadoItem_id;
	$submenu["portada"] = $request->portada;
	$submenu["word"] = $request->word;
	$submenu["fecha"] = $request->fecha;
	$submenu["visitas"] = $request->visitas;
	
    
    if(!empty($_FILES)){    
        $submenuFile = $_FILES[0];			
		$submenu["filenameFoto"]= $submenuFile['name'];
        guardarArchivo($submenuFile, $submenu['id']);
    }else{	
		$submenu["filenameFoto"]= $request->filenameFoto;
	}
	
    
	$n = new Submenu();
    if($n->update($submenu)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "submenu actualizada"
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al actualizar submenu"
        ));
    }
}

function eliminar($request){
    require("../models/submenu.php");
    $n = new Submenu();
    if($n->remove($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "submenu eliminada"
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error ..."
        ));
    }
}

function listar($request){
    require("../models/submenu.php");
    $n = new Submenu();
    if($submenus = $n->get($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $submenus
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener submenus"
        ));
    }
}

function listarOtros($request){
    require("../models/submenu.php");
    $s = new Submenu();
    if($submenus = $s->getOtros($request->id_actual)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $submenus
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener los otros"
        ));
    }
}

function listarAll($request){
    require("../models/submenu.php");
    $n = new Submenu();
    if($submenus = $n->getAll($request->menu_id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $submenus
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener submenus"
        ));
    }
}



function listarAllPortada2(){
    require("../models/submenu.php");
    $n = new Submenu();
    if($submenus = $n->getAllPortada2()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $submenus
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener submenus"
        ));
    }
}


function listarAllAll(){
    require("../models/submenu.php");
    $n = new Submenu();
    if($submenus = $n->getAllAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $submenus
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener submenus"
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
        listarAll($request);
        break;	
	case "listarAllPortada2":
        listarAllPortada2();
        break;
    case "listarAllAll":
        listarAllAll();
        break;	
    case "eliminar":
        eliminar($request);
        break;
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formadu"
        ));
        break;
}