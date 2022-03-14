<?php
require_once("connection.php");
require_once("amigable2.php");

class Submenu
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
    
	 public function getAllAll(){
        $query = "SELECT id, titulo, descripcion, pathFoto, filenameFoto, menu_id, estadoItem_id, portada, word, fecha, visitas FROM submenu ORDER BY id ASC";
        $submenus = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
                $submenus[] = $fila;
            }
            $result->free();
        }
        return $submenus;
    }
	
    public function getAll($menu_id){
        $query = "SELECT submenu.id as id, submenu.titulo as titulo, submenu.descripcion as descripcion, submenu.pathFoto as pathFoto, submenu.filenameFoto as filenameFoto, submenu.fecha as fecha, submenu.visitas as visitas, submenu.menu_id as menu_id, submenu.estadoItem_id as estadoItem, submenu.portada as portada, submenu.word as word, menu.titulo as tituloMenu FROM submenu inner join menu on submenu.menu_id = menu.id WHERE submenu.menu_id = $menu_id ORDER BY id ASC";
        $submenus = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$fila["tituloMenu_ami"] =  urls_amigables2($fila["tituloMenu"]);
                $submenus[] = $fila;
            }
            $result->free();
        }
        return $submenus;
    }
	
	public function getOtros($submenu_id){
		$id = (int) $this->connection->real_escape_string($submenu_id);
        $query = "SELECT id, titulo, descripcion, pathFoto, filenameFoto, menu_id, estadoItem_id, portada, word, fecha, visitas FROM submenu WHERE id <> $id ";
        $submenus = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
                $submenus[] = $fila;
            }
            $result->free();
        }
        return $submenus;
    }
	
	public function getAllPortada2(){
        $query = "SELECT submenu.id as id, submenu.titulo as titulo, submenu.descripcion as descripcion, submenu.fecha, submenu.visitas, submenu.pathFoto as pathFoto, submenu.filenameFoto as filenameFoto, submenu.menu_id as menu_id, submenu.estadoItem_id as estadoItem, submenu.portada as portada, submenu.word as word, menu.titulo as tituloMenu 
					FROM submenu inner join menu on submenu.menu_id = menu.id 
					WHERE submenu.portada=1 ORDER BY id ASC";
        $submenus = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$fila["tituloMenu_ami"] =  urls_amigables2($fila["tituloMenu"]);
                $submenus[] = $fila;
            }
            $result->free();
        }
        return $submenus;
    }
	
	public function getPortadaByMenu($menu_id){
        $query = "SELECT submenu.id as id, submenu.titulo as titulo, submenu.descripcion as descripcion, submenu.fecha, submenu.visitas, submenu.pathFoto as pathFoto, submenu.filenameFoto as filenameFoto, submenu.menu_id as menu_id, submenu.estadoItem_id as estadoItem, submenu.portada as portada, submenu.word as word, menu.titulo as tituloMenu 
					FROM submenu inner join menu on submenu.menu_id = menu.id 
					WHERE $menu_id=submenu.menu_id and submenu.portada=1 ORDER BY id ASC";
        $submenus = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$fila["tituloMenu_ami"] =  urls_amigables2($fila["tituloMenu"]);
                $submenus[] = $fila;
            }
            $result->free();
        }
        return $submenus;
    }
	
	
    public function get($submenuId){
        $id = (int) $this->connection->real_escape_string($submenuId);
        $query = "SELECT submenu.id AS id, submenu.fecha, submenu.visitas, submenu.titulo as titulo, submenu.descripcion as descripcion, submenu.pathFoto as pathFoto, submenu.filenameFoto as filenameFoto, submenu.menu_id as menu_id, submenu.estadoItem_id as estadoItem_id, submenu.portada as portada, submenu.word as word, menu.titulo as tituloMenu FROM submenu inner join menu on submenu.menu_id = menu.id WHERE submenu.id = $submenuId";
        $r = $this->connection->query($query);
        $fila = $r->fetch_assoc();
		if ($fila){
			$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
			$fila["tituloMenu_ami"] =  urls_amigables2($fila["tituloMenu"]);
		}
		return $fila;
    }
    
      
    public function create($submenu){
	$menu_id = $this->connection->real_escape_string($submenu['menu_id']);
        $titulo = $this->connection->real_escape_string($submenu['titulo']);                
        $descripcion = $this->connection->real_escape_string($submenu['descripcion']);
		$pathFoto = $submenu['pathFoto'];
        $filenameFoto = $submenu['filenameFoto'];
	$portada = $this->connection->real_escape_string($submenu['portada']) === 'true' ? '1': '0';
	$word = $this->connection->real_escape_string($submenu['word']) === 'true' ? '1': '0';
	$fecha = $this->connection->real_escape_string($submenu['fecha']) === 'true' ? '1': '0';
	$visitas = $this->connection->real_escape_string($submenu['visitas']) === 'true' ? '1': '0';
	$estadoItem_id =   $submenu['estadoItem_id'];
        
        $query = "INSERT INTO submenu VALUES (
                    DEFAULT,
                    '$titulo',                    
                    '$descripcion',
                    '$pathFoto',
					'$filenameFoto',
                    '$menu_id',
					 '$estadoItem_id',
					 '$portada',
					 '$word',
					 '$fecha',
					 '$visitas'
		    )";
      
         
        
        if($this->connection->query($query)){            
            $submenu['id'] = $this->connection->insert_id;
            return $submenu;
        }else{
            return false;
        }
        
       
    }

    public function update($submenu){
	$menu_id = $this->connection->real_escape_string($submenu['menu_id']);
        $id = (int) $this->connection->real_escape_string($submenu['id']);
        $titulo = $this->connection->real_escape_string($submenu['titulo']);        
        $descripcion = $this->connection->real_escape_string($submenu['descripcion']);
	$pathFoto = $submenu['pathFoto'];
        $filenameFoto = $submenu['filenameFoto'];
		$estadoItem_id = $submenu['estadoItem_id'];
		$portada = $this->connection->real_escape_string($submenu['portada']) === 'true' ? '1': '0';
		$word = $this->connection->real_escape_string($submenu['word']) === 'true' ? '1': '0';
        $fecha = $this->connection->real_escape_string($submenu['fecha']) === 'true' ? '1': '0';
		$visitas = $this->connection->real_escape_string($submenu['visitas']) === 'true' ? '1': '0';
	
        $query = "UPDATE submenu SET
					menu_id = '$menu_id',
                    titulo = '$titulo',                    
                    descripcion = '$descripcion',
					pathFoto = '$pathFoto',
                    filenameFoto = '$filenameFoto',
					estadoItem_id = '$estadoItem_id',
					portada = '$portada',
					word = '$word',
					fecha = '$fecha',
					visitas = '$visitas'
                  WHERE id = $id";
        return $this->connection->query($query);
    }

    public function remove($submenuId){
        $id = (int) $this->connection->real_escape_string($submenuId);
        $query = "DELETE FROM submenu
                  WHERE id = $id";
        return $this->connection->query($query);
    }
}