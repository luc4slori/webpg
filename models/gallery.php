<?php
require_once("connection.php");

class Gallery
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
    		
	 public function getAllAllAll(){
		$query = "SELECT id, pathFoto, filenameFoto FROM notas where filenameFoto<>''";
		$notas = array();
		if( $result = $this->connection->query($query) ){
		    while($fila = $result->fetch_assoc()){
			$notas[] = $fila;
		    }
		    $result->free();
		}
		return $notas;
	}
	
	 public function getAllAll($MenuId){
		$menuId = (int) $this->connection->real_escape_string($MenuId);
		$query = "SELECT notas.id as id, notas.pathFoto as pathFoto, notas.filenameFoto as filenameFoto FROM notas inner join submenu on notas.submenu_id = submenu.id where submenu.menu_id=$menuId and notas.filenameFoto<>''";
		$notas = array();
		if( $result = $this->connection->query($query) ){
		    while($fila = $result->fetch_assoc()){
			$notas[] = $fila;
		    }
		    $result->free();
		}
		return $notas;
	}
	
	 public function getAll($SubmenuId){
		$submenuId = (int) $this->connection->real_escape_string($SubmenuId);
		$query = "SELECT notas.id as id, notas.pathFoto as pathFoto, notas.filenameFoto as filenameFoto FROM notas inner join submenu on notas.submenu_id = submenu.id where notas.submenu_id=$submenuId and notas.filenameFoto<>''";
		$notas = array();
		if( $result = $this->connection->query($query) ){
		    while($fila = $result->fetch_assoc()){
			$notas[] = $fila;
		    }
		    $result->free();
		}
		return $notas;
	}
    
    
}