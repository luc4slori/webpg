<?php
require_once("connection.php");
require_once("amigable2.php");

class Menu
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
    
		
	public function getMedioIndex(){
        $query = "SELECT menu.id, menu.titulo, menu.pathFoto, menu.filenameFoto, submenu.id, submenu.titulo, submenu.descripcion, submenu.pathFoto, submenu.filenameFoto, publi.id, publi.href, publi.pathFoto, publi.filenameFoto FROM menu inner join submenu ON submenu.menu_id=menu.id inner join publi ON publi.menu_id=menu.id ORDER BY menu.id ASC";
		$Menus = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){              
				$Menus[] = $fila;
            }
            $result->free();
        }
        return $Menus;
    }

	
    public function getAll(){
        $query = "SELECT id, titulo, pathFoto, filenameFoto, estadoItem_id FROM menu ORDER BY id ASC";
        $Menus = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$Menus[] = $fila;
            }
            $result->free();
        }
        return $Menus;
    }

    public function get($MenuId){
        $id = (int) $this->connection->real_escape_string($MenuId);
        $query = "SELECT id, titulo, pathFoto, filenameFoto, estadoItem_id FROM menu WHERE id = $id";
        $r = $this->connection->query($query);
        $fila = $r->fetch_assoc();
		if ($fila){
			$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
		}
		return $fila;
    }
	
	public function getOtros($MenuId){
        $id = (int) $this->connection->real_escape_string($MenuId);
        $query = "SELECT id, titulo, pathFoto, filenameFoto, estadoItem_id FROM menu WHERE id <> '$id'";
        $Menus = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$Menus[] = $fila;
            }
            $result->free();
        }
        return $Menus;
    }
    
      
    public function create($Menu){
        $titulo = $this->connection->real_escape_string($Menu['titulo']);	
		$pathFoto = $this->connection->real_escape_string($Menu['pathFoto']);	
		$filenameFoto = $this->connection->real_escape_string($Menu['filenameFoto']);	
		$estadoItem_id = (int) $this->connection->real_escape_string($Menu['estadoItem_id']);	
        
        $query = "INSERT INTO menu VALUES (
                    DEFAULT,
                    '$titulo',
					'$pathFoto',
					'$filenameFoto',
					'$estadoItem_id'
		    )";
      
         
        
        if($this->connection->query($query)){            
            $Menu['id'] = $this->connection->insert_id;
            return $Menu;
        }else{
            return false;
        }
        
       
    }

    public function update($Menu){	
        $id = (int) $this->connection->real_escape_string($Menu['id']);      
        $titulo = $this->connection->real_escape_string($Menu['titulo']);	
		$pathFoto = $this->connection->real_escape_string($Menu['pathFoto']);	
		$filenameFoto = $this->connection->real_escape_string($Menu['filenameFoto']);			
		$estadoItem_id = (int) $this->connection->real_escape_string($Menu['estadoItem_id']);	
        
        $query = "UPDATE menu SET					                                       
                    titulo = '$titulo',
					pathFoto = '$pathFoto',
					filenameFoto = '$filenameFoto',
					estadoItem_id = '$estadoItem_id'
                  WHERE id = $id";
        return $this->connection->query($query);
    }

    public function remove($MenuId){
        $id = (int) $this->connection->real_escape_string($MenuId);
        $query = "DELETE FROM menu
                  WHERE id = $id";
        return $this->connection->query($query);
    }
}