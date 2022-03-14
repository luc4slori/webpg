<?php
require_once("../utils/request.php");
require_once("../models/nota.php");
require_once("../utils/amigable.php");

require_once ("PHPWord-master/src/PhpWord/Autoloader.php");
	\PhpOffice\PhpWord\Autoloader::register();

	//use PhpOffice\PhpWord\PhpWord;
	//use PhpOffice\PhpWord\Style\Font;
	use PhpOffice\PhpWord\TemplateProcessor;

function sendResponse($response){
    echo json_encode($response);
}



function guardarWord($nota, $fechaNota, $hayFoto){
	
	//$hayFoto no lo uso en esta version con TemplateProcessor
	
	$templateWord = new TemplateProcessor('plantilla.docx');
	$uploaddir = "../files/nota/";
    $notaDir = $uploaddir . $nota["id"];
	$filenameWord = $fechaNota.".docx";	
	$fullFile = $notaDir."/".$filenameWord;
	$titulo_amigable = urls_amigables($nota["titulo"]);
	
	$temporal = getNotaParaWord($nota["id"]);
	
	
	$urlNota = "http://proyectogeo.com/".$temporal['tituloMenu_ami']."/".$temporal['tituloSubmenu_ami']."/".$nota['id']."-".$titulo_amigable;
	
	
	
	$templateWord->setValue('fecha1',$fechaNota);
	$templateWord->setValue('fecha2',$fechaNota);
	$templateWord->setValue('url1',$urlNota);
	$templateWord->setValue('url2',$urlNota);
	$templateWord->setValue('titulo',$nota["titulo"]);
	$templateWord->setValue('subtitulo',$nota["subtitulo"]);
	$templateWord->setValue('descripcion',$nota["descripcion"]);
	
	$templateWord->saveAs($fullFile);
	
	//header("Content-Disposition: attachment; filename=Documento02.docx; charset=iso-8859-1");
	//echo file_get_contents($fullFile);
	
	}

function guardarArchivo($file, $notaId){
    $uploaddir = "../files/nota/";
    $notaDir = $uploaddir . $notaId;
	$file_name = $file['name'];
	
	if (move_uploaded_file($file['tmp_name'], $notaDir . "/" . $file_name)){
		return true;
	} 
	return false;
	
  }

function creadoDir($id){
	$nuevodir = "../files/nota/";
    $notaDir = $nuevodir . $id . "/";
	if (!file_exists($notaDir)) {
		if(!mkdir($notaDir, 0777, true)){
			return false;
		}
	}
	return true;
}

function getNotaParaWord($idNota){	
	$nota = array();    
    $n = new Nota();
    $nota = $n->get($idNota);
	return $nota;
}

function menuName($idNota){	
	$nota = array();    
    $n = new Nota();
    $nota = $n->get($idNota);
	return $nota["tituloSubmenu"];
}


function crearNota ($nota,$fileNameFoto, $fechaNota){
	
	$n = new Nota();
	

	
	$nueva = $n->create(array(
		"titulo" => $nota->titulo,
		"subtitulo" => $nota->subtitulo,
		"descripcion" =>  $nota->descripcion,
		"autor" =>  $nota->autor,
		"pathFoto"  =>  $nota->pathFoto,
		"submenu_id" =>  $nota->submenu_id,
		"estadoItem_id" =>  $nota->estadoItem_id,
		"vistas" =>  $nota->vistas,
		"carrusel"=> $nota->carrusel,
		"word"=> $nota->word,
		"twitter" => $nota->twitter,
		"status" => $nota->status,
		"ennota" => $nota->ennota,
		"enhome" => $nota->enhome,
		"cards" => $nota->cards,
		"conversation" => $nota->conversation,
		"video"=> $nota->video,
		"imagenpor"=> $nota->imagenpor,
		"fechaNota"=> $fechaNota,
		"filenameFoto"  =>  $fileNameFoto
		));
	
	if ($nueva){
		return $nueva;
	}
	
	return false;
	
	
}

function nueva($request){
   
	
	$fechaNota = DateTime::createFromFormat('Y-m-d\TH:i:s', $request->fechaNota);
	$fechaNota ->sub(new DateInterval('PT3H'));
	$fechaNota = $fechaNota->format('Y-m-d H:i:s');
	$fechaWord = DateTime::createFromFormat('Y-m-d H:i:s', $fechaNota);	
	$fechaWord = $fechaWord->format('d-m-Y');
	$word = $request->word;
	
	
	$fileNameFoto = "";
	$oridir ="";
	$orinota = "";
	
	if(!empty($_FILES)){    														
			$fileNameFoto = $_FILES[0]['name'];
			$guardarImagen = true;
	} else {
			$fileNameFoto = $request->fileNameFoto;	
			$guardarImagen = false;		
	}
		
	$nueva = crearNota ($request, $fileNameFoto, $fechaNota);
	
	if ($nueva){
		
		if (creadoDir($nueva['id'])){			
			if ($request->copyFileId){
					
				$oridir = "../files/nota/";
				$orinota = $oridir . $request->copyFileId . '/'. $fileNameFoto;					
				$destnota = $oridir . $nueva['id'] . '/'. $fileNameFoto;
				if ($fileNameFoto !=""){			
					copy($orinota, $destnota);
					
					if (word == 'true'){
							guardarWord($nueva, $fechaWord, true);
					}
					
					sendResponse(array(
						"error" => false,
						"mensaje" => "nota creada con copia de foto",
						"data" => $nueva
						
					));
				} else {
					
					if ($word == 'true'){
						guardarWord($nueva, $fechaWord, false);
					}
					
					sendResponse(array(
						"error" => false,
						"mensaje" => "nota creada sin copia de foto solicitada",
						"data" => $nueva
					));
				}
			
			} else {			
				if ($guardarImagen){					
					if(guardarArchivo($_FILES[0], $nueva['id'])){
						
						if ($word == 'true'){
							guardarWord($nueva, $fechaWord, true);
						}
						
						sendResponse(array(
							"error" => false,
							"mensaje" => $fechaWord,
							"data" => $nueva
						));
					}else{
						
						if ($word == 'true'){
							guardarWord($nueva, $fechaWord, false);
						}
						
						sendResponse(array(
							"error" => false,
							"mensaje" => "se guardo nota, pero no pudo guardar foto",
							"data" => $nueva
						));
					}
				}else{
					
						if ($word == 'true'){
							guardarWord($nueva, $fechaWord, false);
						}
						
						sendResponse(array(
							"error" => false,
							"mensaje" => "se guardo nota, sin foto solicitada",
							"data" => $nueva
						));
				}
				
			}
			
		}else{
			sendResponse(array(
				"error" => false,
				"mensaje" => "Se creo nota corrupta, sin directorio",
				"data" => $nueva				
			));
		}	
				
	} else {
			sendResponse(array(
				"error" => true,
				"mensaje" => "No se pudo crear nota"				
			));
	}
}
function eliminarDelCarrusel($request){

	 $nota = array();	 
	 
    $nota["id"] = $request->id;
	
	$n = new Nota();
    if($n->eliminarDelCarrusel($nota)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "eliminada del carrusel"
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al eliminar del carrusel"
        ));
    }
}

function agregarAlCarrusel($request){

	 $nota = array();	 
	 
    $nota["id"] = $request->id;
	
	$n = new Nota();
    if($n->agregarAlCarrusel($nota)){		
			sendResponse(array(
				"error" => false,
				"mensaje" => "eliminada del carrusel"
            ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al eliminar del carrusel"
        ));
    }
}

function actualizar($request){

	 $nota = array();
	 $notaFile=null;
	
	$fechaNota = DateTime::createFromFormat('Y-m-d\TH:i:s', $request->fechaNota);
	$fechaNota ->sub(new DateInterval('PT3H'));
	$fechaNota = $fechaNota->format('Y-m-d H:i:s');
	$fechaWord = DateTime::createFromFormat('Y-m-d H:i:s', $fechaNota);	
	$fechaWord = $fechaWord->format('d-m-Y');
	
    $nota["submenu_id"] = $request->submenu_id;
    $nota["vistas"] = $request->vistas;
    $nota["id"] = $request->id;
    $nota["titulo"] = $request->titulo;
    $nota["subtitulo"] = $request->subtitulo;
    $nota["descripcion"] = $request->descripcion;
	$nota["autor"] = $request->autor;
    $nota["pathFoto"] = $request->pathFoto;
    $nota["estadoItem_id"] = $request->estadoItem_id;
	$nota["carrusel"] = $request->carrusel;
	$nota["word"] = $request->word;
	$nota["twitter"] = $request->twitter;	
	$nota["status"] = $request->status;
	$nota["ennota"] = $request->ennota;
	$nota["enhome"] = $request->enhome;
	$nota["cards"] = $request->cards;
	$nota["conversation"] = $request->conversation;
	$nota["video"] = $request->video;	
	$nota["imagenpor"] = $request->imagenpor;
	$nota["fechaNota"] = $fechaNota;	
    
	$fileNameFoto = "";
	$oridir ="";
	$orinota = "";
	
	$word = $request->word;
	
	if(!empty($_FILES)){    														
			$nota["filenameFoto"] = $_FILES[0]['name'];
			$guardarImagen = true;
	} else {
			$nota["filenameFoto"] = $request->fileNameFoto;	
			$guardarImagen = false;		
	}
	
	if (creadoDir($nota['id'])){
	
		if ($request->copyFileId){			
			sendResponse(array(
					"error" => false,
					"mensaje" => "nota actualizada"
				));		
			
			if ($nota["filenameFoto"] !=""){
				$oridir = "../files/nota/";
				$orinota = $oridir . $request->copyFileId . '/'. $nota["filenameFoto"];			
				$destnota = $oridir . $nota['id'] . '/'. $nota["filenameFoto"];
				copy($orinota, $destnota);
				if ($word == 'true'){
					guardarWord($nota, $fechaWord, true);
				}
			} else {
				if ($word == 'true'){
					guardarWord($nota, $fechaWord, false);
				}				
			}			
			
		} else {		
			
			
			if($guardarImagen){    								
				guardarArchivo($_FILES[0], $nota['id']);
			}
			
			if ($word == 'true'){
				if($request->fileNameFoto==="") {
					guardarWord($nota, $fechaWord, false);
				} else {
					
					guardarWord($nota, $fechaWord, true);
				}
				
			}
			
			
			
			
		}
    
			
		$n = new Nota();
		if($n->update($nota)){		
				sendResponse(array(
					"error" => false,
					"mensaje" => "nota actualizada"
				));
		}else{
			sendResponse(array(
				"error" => true,
				"mensaje" => "Error al actualizar nota"
			));
		}
		
	} else {		
		sendResponse(array(
            "error" => true,
            "mensaje" => "Error al actualizar nota al no poder crear directorio"
        ));
		
	}
	
}

function eliminar($request){

    $n = new Nota();
    if($n->remove($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "nota eliminada"
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error ..."
        ));
    }
}

function listar($request){
   
    $n = new Nota();
    if($notas = $n->get($request->id)){
				
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function getNotasConVisitas($request){
    $n = new Nota();
    if($notas = $n->getNotasConVisitas($request->submenu_id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function listarAll($request){
    $n = new Nota();
    if($notas = $n->getAll($request->submenu_id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function listarAllAdmin($request){

    $n = new Nota();
    if($notas = $n->getAllAdmin($request->submenu_id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => fase,
            "mensaje" => "No se encontraron notas"
        ));
    }
}


function getFromQuery($request){

    $n = new Nota();
    if($notas = $n->getFromQuery($request->searchQuery)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function getLastNFromSubmenu($request){

    $n = new Nota();
    if($notas = $n->getLastNFromSubmenu($request->submenu_id, $request->n, $request->offset)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function searchNota($request){
 
    $n = new Nota();
    if($notas = $n->searchNota($request->textnota)){
	
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function listarAllDiez($request){

    $n = new Nota();
    if($notas = $n->getAllDiez($request->submenu_id,$request->id_actual)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function loUltimo(){
    $n = new Nota();
    if($notas = $n->getLoUltimo()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function oldNotas($request){
    $n = new Nota();
    if($notas = $n->getOldNotas($request->offset)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function listarAllAll(){

    $n = new Nota();
    if($notas = $n->getAllAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener notas"
        ));
    }
}

function urlAmigable($request){
	if ($titulo_amigable = urls_amigables($request->titulo)){
		 sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $titulo_amigable
        ));
		
	} else {
		  sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener titulo amigable"
        ));
		
	}
}

function listarCarrusel(){
  
    $n = new Nota();
    if($notas = $n->getCarrusel()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener carrusel"
        ));
    }
}

function listarCarruselAmi(){
    
    $n = new Nota();
    if($notas = $n->getCarruselAmi()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $notas
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener carrusel"
        ));
    }
}


$request = new Request();
$action = $request->action;
switch($action){
	
	case "getFromQuery":
        getFromQuery($request);
        break; 
	case "getLastNFromSubmenu":
        getLastNFromSubmenu($request);
        break;   
     case "loUltimo":
        loUltimo();
        break;
	case "guardar":
        nueva($request);
        break;   
    case "actualizar":
        actualizar($request);
        break;
     case "listar":
        listar($request);
        break; 
	
	case "getNotasConVisitas":
        getNotasConVisitas($request);
        break;
    case "listarAll":
        listarAll($request);
        break;
	case "listarAllAdmin":
        listarAllAdmin($request);
        break;
    case "listarAllDiez":
        listarAllDiez($request);
        break;
    case "listarAllAll":
        listarAllAll();
        break;
    case "listarCarrusel":
        listarCarrusel();
        break;
	case "listarCarruselAmi":
        listarCarruselAmi();
        break;	
     case "searchNota":
        searchNota($request);
        break;
    case "eliminar":
        eliminar($request);
        break;
	case "eliminarDelCarrusel":
        eliminarDelCarrusel($request);
        break;
	case "agregarAlCarrusel":
        agregarAlCarrusel($request);
        break;
	case "urlAmigable":
        urlAmigable($request);
        break;	
	case "oldNotas":
        oldNotas($request);
        break;	
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formadu"
        ));
        break;
}
