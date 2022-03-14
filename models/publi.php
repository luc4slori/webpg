<?php
require_once("connection.php");

class Publi
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
    
	public function setDelay($timePopup){		
        $timePopup = (int) $this->connection->real_escape_string($timePopup);
        
        $query = "UPDATE publi SET							
					timePopup = '$timePopup'";
        return $this->connection->query($query);
    }
	 public function getDelay(){        
        $query = "SELECT timePopup FROM publi LIMIT 1";
        $r = $this->connection->query($query);
		$fila = $r->fetch_assoc();
        return intval($fila["timePopup"]);
    }	
	
	public function getHeaderPubli(){        
        $query = "SELECT id, href, pathFoto, filenameFoto, menu_id, estadoItem_id, enPopup, enHeader, enFooter, enIndex, enNota, enDerecha, timePopup FROM publi 
				WHERE enHeader = 1";
       $publis = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $publis[] = $fila;
            }
            $result->free();
        }
        return $publis;
    }
	
	public function getFooterPubli(){        
        $query = "SELECT id, href, pathFoto, filenameFoto, menu_id, estadoItem_id, enPopup, enHeader, enFooter, enIndex, enNota, enDerecha, timePopup FROM publi 
				WHERE enFooter = 1";
       $publis = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $publis[] = $fila;
            }
            $result->free();
        }
        return $publis;
    }
	
	public function getPubliEnNota(){        
        $query = "SELECT id, href, pathFoto, filenameFoto, menu_id, estadoItem_id, enPopup, enHeader, enFooter, enIndex, enNota, enDerecha, timePopup FROM publi 
				WHERE enNota = 1";
       $publis = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $publis[] = $fila;
            }
            $result->free();
        }
        return $publis;
    }
	
	public function getPopup(){        
        $query = "SELECT id, href, pathFoto, filenameFoto, menu_id, estadoItem_id, enPopup, enHeader, enFooter, enIndex, enNota, enDerecha, timePopup FROM publi 
				WHERE enPopup = 1";
       $publis = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $publis[] = $fila;
            }
            $result->free();
        }
        return $publis;
    }
	
	 public function getAllAll(){
        $query = "SELECT id, href, estadoItem_id, pathFoto, filenameFoto, menu_id, enPopup, enHeader, enFooter, enIndex, enNota, enDerecha, timePopup 
			FROM publi 
			WHERE  estadoItem_id='1' OR enDerecha='1'
			ORDER BY estadoItem_id,menu_id ASC";
        $publis = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $publis[] = $fila;
            }
            $result->free();
        }
		
        return $publis;
    }
	
	/*inactivo por ahora
	public function getBannersHeader(){
        $query = "SELECT id, href, pathFoto, filenameFoto, menu_id, estadoItem_id FROM publi ORDER BY menu_id ASC";
        $publis = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $publis[] = $fila;
            }
            $result->free();
        }
        return $publis;
    }
	*/
	public function getAllAllAdmin(){
        $query = "SELECT id, href, pathFoto, filenameFoto, menu_id, estadoItem_id, enPopup, enHeader, enFooter, enIndex, enNota, enDerecha, timePopup FROM publi ORDER BY menu_id ASC";
        $publis = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $publis[] = $fila;
            }
            $result->free();
        }
        return $publis;
    }
	
    public function getPubliv2Index($offset){
        $query = "SELECT id, href, pathFoto, filenameFoto, menu_id, estadoItem_id, enPopup, enHeader, enFooter, enIndex, enNota, enDerecha, timePopup 
					FROM publi 
					WHERE enIndex='1' 
					ORDER BY menu_id ASC LIMIT 2 OFFSET $offset";
        $publis = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $publis[] = $fila;
            }
            $result->free();
        }
        return $publis;
    }
	
	public function getAll($menu_id){
        $query = "SELECT id, href, pathFoto, filenameFoto, menu_id, estadoItem_id, enPopup, enHeader, enFooter, enIndex, enNota, enDerecha, timePopup 
		FROM publi WHERE estadoItem_id='1' AND menu_id = $menu_id ORDER BY menu_id ASC";
        $publis = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $publis[] = $fila;
            }
            $result->free();
        }
        return $publis;
    }

    public function get($publiId){
        $id = (int) $this->connection->real_escape_string($publiId);
        $query = "SELECT id, href, pathFoto, filenameFoto, menu_id, estadoItem_id, enPopup, enHeader, enFooter, enIndex, enNota, enDerecha, timePopup FROM publi WHERE id = $publiId";
        $r = $this->connection->query($query);
        return $r->fetch_assoc();
    }
    
      
    public function create($publi){
		$menu_id = $this->connection->real_escape_string($publi['menu_id']);
        $href = $this->connection->real_escape_string($publi['href']);                        
		$pathFoto = $publi['pathFoto'];
        $filenameFoto = $publi['filenameFoto'];
		$estadoItem_id =  $this->connection->real_escape_string($publi['estadoItem_id']);
        
        $query = "INSERT INTO publi VALUES (
                    DEFAULT,
                    '$pathFoto',                    
                    '$filenameFoto',
                    '$href',
					'$estadoItem_id',
                    '$menu_id',
					DEFAULT,
					DEFAULT,
					DEFAULT,
					DEFAULT,
					DEFAULT,
					DEFAULT,
					DEFAULT
					
		    )";      
         
        
        if($this->connection->query($query)){            
            $publi['id'] = $this->connection->insert_id;
            return $publi;
        }else{
            return false;
        }
        
       
    }

	
	public function publicidadRepositorio($publi){		
        $id = (int) $this->connection->real_escape_string($publi['id']);
        
        $query = "UPDATE publi SET							
					estadoItem_id = '2',
					enPopup = '2',
					enHeader = '2',
					enFooter = '2',
					enIndex = '2',
					enNota = '2',
					enDerecha = '2'					
                  WHERE id = $id";
        return $this->connection->query($query);
    }
	/*
	public function updateEstado($publi){		
        $id = (int) $this->connection->real_escape_string($publi['id']);
        $menu_id = $this->connection->real_escape_string($publi['menu_id']);
		$estadoItem_id = $publi['estadoItem_id'];
        
        $query = "UPDATE publi SET		
					menu_id = '$menu_id',
					estadoItem_id = '$estadoItem_id'
                  WHERE id = $id";
        return $this->connection->query($query);
    }
	*/
	public function updateEstadov2($publi){		
		$id = $this->connection->real_escape_string($publi['id']);
        $lugarPubli = $this->connection->real_escape_string($publi['lugarPubli']);
        $href = is_null($publi['href']) ? "0" : $this->connection->real_escape_string($publi['href']);                
		$pathFoto = is_null($publi['pathFoto']) ? "0" : $this->connection->real_escape_string($publi['pathFoto']); 
        $filenameFoto = is_null($publi['filenameFoto']) ? "0" : $this->connection->real_escape_string($publi['filenameFoto']); 
		$timePopup = is_null($publi['timePopup']) ? "1" : $this->connection->real_escape_string($publi['timePopup']); 
		$menu_id = is_null($publi['menu_id']) ? "0" : $this->connection->real_escape_string($publi['menu_id']); 
        
        $query = "UPDATE publi SET							
					estadoItem_id = IF ('$lugarPubli'='enMenus',1,2),
					enPopup = IF ('$lugarPubli'='enPopup',1,2),
					enHeader = IF ('$lugarPubli'='enHeader',1,2),
					enFooter = IF ('$lugarPubli'='enFooter',1,2),
					enIndex = IF ('$lugarPubli'='enIndex',1,2),
					enNota = IF ('$lugarPubli'='enNota',1,2),
					enDerecha = IF ('$lugarPubli'='enDerecha',1,2),
					href = IF ('$href'='0',href,'$href'),
					pathFoto = IF ('$pathFoto'='0',pathFoto,'$pathFoto'),
					filenameFoto = IF ('$filenameFoto'='0',filenameFoto,'$filenameFoto'),
					timePopup = IF ('$lugarPubli'='enPopup','$timePopup', timePopup),
					menu_id = IF ('$menu_id'='0', menu_id, '$menu_id')
                  WHERE id = $id";
				  
        return $this->connection->query($query);
    }

		
    public function update($publi){
		//$menu_id = $this->connection->real_escape_string($publi['menu_id']);
        $id = (int) $this->connection->real_escape_string($publi['id']);
        $href = $this->connection->real_escape_string($publi['href']);                
		$pathFoto = $publi['pathFoto'];
        $filenameFoto = $publi['filenameFoto'];
		$estadoItem_id = $publi['estadoItem_id'];
        
        $query = "UPDATE publi SET					
                    href = '$href',                                        
					pathFoto = '$pathFoto',
                    filenameFoto = '$filenameFoto',
					estadoItem_id = '$estadoItem_id'
                  WHERE id = $id";
        return $this->connection->query($query);
    }

    public function remove($publiId){
        $id = (int) $this->connection->real_escape_string($publiId);
        $query = "DELETE FROM publi WHERE id = $id";
        return $this->connection->query($query);
    }
}