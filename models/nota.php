<?php
require_once("connection.php");
require_once("amigable2.php");

class Nota
{
    private $connection;    
	
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
    
	public function addVista($id){
		$id = (int) $this->connection->real_escape_string($id);
            
        $query = "UPDATE notas SET
					vistas = vistas + 1
                  WHERE id = $id";
				  
        return $this->connection->query($query);
	}
	
	public function getOldNotas($offset){
        $query = "SELECT nota.id, nota.titulo, nota.subtitulo, nota.pathFoto, nota.filenameFoto, 
					DATE_FORMAT(nota.fechaNota,'%d-%m-%Y') as fechaNotaUser, 
					DATE_FORMAT(nota.fechaNota,'%H:%i') as horaNotaUser , 
					nota.autor, nota.video, nota.imagenpor,
					IF(submenu.fecha=1,submenu.fecha,NULL) as fechavisible,
					bt.status as twitter_status,
					bt.ennota as twitter_ennota,
					bt.enhome as twitter_enhome,
					bt.conversation as twitter_conversation,
					bt.cards as twitter_cards,
					bt.is_active as twitter
					
					FROM notas as nota
					LEFT JOIN blog_twitter bt ON bt.nota_id = nota.id
					inner join submenu on submenu.id = nota.submenu_id
					WHERE nota.estadoItem_id='1' and nota.fechaNota<NOW() 
					ORDER BY nota.fechaNota DESC LIMIT 2 OFFSET $offset";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
	
	
	 public function getLoUltimo(){
        $query = "SELECT nota.id, nota.titulo, nota.subtitulo, nota.pathFoto, nota.filenameFoto, 
					DATE_FORMAT(nota.fechaNota,'%d-%m-%Y') as fechaNotaUser, 
					DATE_FORMAT(nota.fechaNota,'%H:%i') as horaNotaUser , 
					nota.autor, nota.video, nota.imagenpor,
					IF(submenu.fecha=1,submenu.fecha,NULL) as fechavisible,
					
					bt.status as twitter_status,
					bt.ennota as twitter_ennota,
					bt.enhome as twitter_enhome,
					bt.conversation as twitter_conversation,
					bt.cards as twitter_cards,
					bt.is_active as twitter
					
					FROM notas as nota
					LEFT JOIN blog_twitter bt ON bt.nota_id = nota.id
					inner join submenu on submenu.id = nota.submenu_id
					WHERE nota.estadoItem_id='1' and nota.fechaNota<NOW() 
						AND (bt.is_active = 1 OR bt.is_active IS NULL)
					ORDER BY nota.fechaNota DESC LIMIT 16";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
	
	
	 public function getAllAllASC(){
        $query = "SELECT id, titulo, subtitulo, descripcion, pathFoto, filenameFoto, vistas, fechaNota, submenu_id, estadoItem_id , autor, video, imagenpor FROM notas ORDER BY id ASC";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
	
	 public function getAllAll(){
        $query = "SELECT id, titulo, subtitulo, descripcion, pathFoto, filenameFoto, vistas, fechaNota, submenu_id, estadoItem_id , autor, video, imagenpor FROM notas ORDER BY id DESC";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
    
	
	 public function getCarruselAmi(){
        $query = "SELECT notas.id as id, notas.titulo as titulo, notas.subtitulo as subtitulo, notas.pathFoto as pathFoto, notas.filenameFoto as filenameFoto,  notas.estadoItem_id as estadoItem_id, notas.carrusel as  carrusel, notas.autor as autor, notas.video as video, notas.imagenpor as imagenpor, submenu.titulo as tituloSubmenu, menu.titulo as tituloMenu FROM notas inner join submenu ON submenu.id=notas.submenu_id inner join menu ON submenu.menu_id = menu.id WHERE notas.carrusel='1' ";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$fila["tituloSubmenu_ami"] =  urls_amigables2($fila["tituloSubmenu"]);
				$fila["tituloMenu_ami"] =  urls_amigables2($fila["tituloMenu"]);
				
				$notas[] = $fila;
				
            }
            $result->free();
        }
        return $notas;
    }
	
     public function getCarrusel(){
        $query = "SELECT id, titulo, subtitulo, pathFoto, filenameFoto,  estadoItem_id, carrusel , autor, video, imagenpor FROM notas WHERE carrusel='1' ";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
	
	public function getNotasConVisitas($submenu_id){	  
        $query = "SELECT notas.id as id, notas.titulo as titulo, notas.subtitulo as subtitulo, 
					notas.descripcion as descripcion, notas.pathFoto as pathFoto, 
					notas.filenameFoto as filenameFoto, notas.vistas as vistas, 
					notas.submenu_id as submenu_id, notas.estadoItem_id as estadoItem_id, 
					notas.fechaNota as fechaNota, 
					DATE_FORMAT(notas.fechaNota,'%d-%m-%Y') as fechaNotaUser, 
					DATE_FORMAT(notas.fechaNota,'%H:%i') as horaNotaUser , 
					notas.autor as autor, notas.video as video, notas.imagenpor as imagenpor, 
					submenu.titulo as tituloSubmenu, menu.titulo as tituloMenu,
					IF(submenu.fecha=1,submenu.fecha,NULL) as fechavisible,
					IF(submenu.visitas=1,submenu.visitas,NULL) as visitas
				FROM notas inner join submenu ON submenu.id=notas.submenu_id 
				inner join menu on submenu.menu_id=menu.id 
				WHERE notas.submenu_id = $submenu_id and notas.fechaNota<NOW() 
				ORDER BY notas.fechaNota DESC ";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$fila["tituloSubmenu_ami"] =  urls_amigables2($fila["tituloSubmenu"]);
				$fila["tituloMenu_ami"] =  urls_amigables2($fila["tituloMenu"]);
				$notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
    public function getAll($submenu_id){	  
        $query = "SELECT notas.id as id, notas.titulo as titulo, notas.subtitulo as subtitulo, notas.descripcion as descripcion, notas.pathFoto as pathFoto, notas.filenameFoto as filenameFoto, notas.vistas as vistas, notas.submenu_id as submenu_id, notas.estadoItem_id as estadoItem_id, notas.fechaNota as fechaNota, DATE_FORMAT(notas.fechaNota,'%d-%m-%Y') as fechaNotaUser, DATE_FORMAT(notas.fechaNota,'%H:%i') as horaNotaUser , notas.autor as autor, notas.video as video, notas.imagenpor as imagenpor, submenu.titulo as tituloSubmenu, menu.titulo as tituloMenu 
					FROM notas 
					inner join submenu ON submenu.id=notas.submenu_id 
					inner join menu on submenu.menu_id=menu.id 
					WHERE notas.submenu_id = $submenu_id and notas.fechaNota<NOW() 
					ORDER BY notas.fechaNota DESC ";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$fila["tituloSubmenu_ami"] =  urls_amigables2($fila["tituloSubmenu"]);
				$fila["tituloMenu_ami"] =  urls_amigables2($fila["tituloMenu"]);
				$notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
	
	 public function getAllAdmin($submenu_id){
        $query = "SELECT IF(NOW() >= `fechaNota`, TRUE, FALSE) as publicado, id, titulo, subtitulo, descripcion, pathFoto, filenameFoto, vistas, submenu_id, estadoItem_id, fechaNota, DATE_FORMAT(fechaNota,'%d-%m-%Y') as fechaNotaUser, DATE_FORMAT(fechaNota,'%H:%i') as horaNotaUser , autor, video, imagenpor 
					FROM notas 
					WHERE submenu_id = $submenu_id 
					ORDER BY notas.fechaNota DESC 
					LIMIT 100";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
    
    public function searchNota($texto){
	$texto = $this->connection->real_escape_string($texto);
        $query = "SELECT id, titulo, subtitulo, pathFoto, filenameFoto,  estadoItem_id, carrusel, word , autor, video, imagenpor FROM notas WHERE ((titulo LIKE '%$texto%') OR   (subtitulo LIKE '%$texto%') OR   (filenameFoto LIKE '%$texto%')) AND ((filenameFoto <>'' ) AND (filenameFoto is not null and filenameFoto <> '' ))";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
    
	
	public function getTendencias ($submenu_id){
        $query = "SELECT id, titulo, subtitulo, descripcion, pathFoto, 
				filenameFoto, vistas, submenu_id, estadoItem_id, fechaNota , autor, video, imagenpor 
				FROM notas WHERE submenu_id = $submenu_id and fechaNota<NOW() ORDER BY notas.fechaNota DESC LIMIT 10";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
	
	
	public function getFromQuery ($searchQuery){		
		$searchQuery = $this->connection->real_escape_string($searchQuery);
        $query = "SELECT LOWER(CONCAT_WS(nota.titulo,nota.subtitulo)) AS concatenated, nota.id, nota.titulo, nota.subtitulo, nota.descripcion, nota.pathFoto, 
				nota.filenameFoto, nota.vistas, nota.submenu_id, nota.estadoItem_id, nota.fechaNota , 
				nota.autor, nota.video, nota.imagenpor, submenu.titulo AS submenu_titulo,
				menu.titulo AS menu_titulo
				FROM notas as nota
				INNER JOIN submenu ON submenu.id = nota.submenu_id
				INNER JOIN menu ON menu.id = submenu.menu_id
				WHERE LOWER(CONCAT_WS(nota.titulo,nota.subtitulo)) LIKE ('%$searchQuery%') AND nota.filenameFoto is NOT NULL AND nota.filenameFoto <> '' and nota.fechaNota<NOW() 
				ORDER BY nota.fechaNota DESC 
				";
				
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$fila["menu_titulo_ami"] =  urls_amigables2($fila["menu_titulo"]);
				$fila["submenu_titulo_ami"] =  urls_amigables2($fila["submenu_titulo"]);
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
	
	public function getLastNFromSubmenu ($submenu_id, $n, $offset){
        $query = "SELECT nota.id, nota.titulo, nota.subtitulo, nota.descripcion, nota.pathFoto, 
				nota.filenameFoto, nota.vistas, nota.submenu_id, nota.estadoItem_id, nota.fechaNota , 
				nota.autor, nota.video, nota.imagenpor, submenu.titulo AS submenu_titulo,
				menu.titulo AS menu_titulo
				FROM notas as nota
				INNER JOIN submenu ON submenu.id = nota.submenu_id
				INNER JOIN menu ON menu.id = submenu.menu_id
				WHERE nota.filenameFoto is NOT NULL AND nota.filenameFoto <> '' AND nota.submenu_id = $submenu_id and nota.fechaNota<NOW() 
				ORDER BY nota.fechaNota 
				DESC LIMIT $n
				OFFSET $offset";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$fila["menu_titulo_ami"] =  urls_amigables2($fila["menu_titulo"]);
				$fila["submenu_titulo_ami"] =  urls_amigables2($fila["submenu_titulo"]);
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
	
	
	public function getMostViewd ($submenu_id, $n, $offset){		
        $query = "SELECT nota.id, nota.titulo, nota.subtitulo, nota.descripcion, nota.pathFoto, 
				nota.filenameFoto, nota.vistas, nota.submenu_id, nota.estadoItem_id, nota.fechaNota , 
				nota.autor, nota.video, nota.imagenpor, submenu.titulo AS submenu_titulo,
				menu.titulo AS menu_titulo
				FROM notas as nota
				INNER JOIN submenu ON submenu.id = nota.submenu_id
				INNER JOIN menu ON menu.id = submenu.menu_id
				WHERE nota.filenameFoto is NOT NULL AND nota.filenameFoto <> '' AND nota.submenu_id = $submenu_id and nota.fechaNota<NOW() 
				ORDER BY nota.vistas 
				DESC LIMIT $n OFFSET $offset";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
				$fila["menu_titulo_ami"] =  urls_amigables2($fila["menu_titulo"]);
				$fila["submenu_titulo_ami"] =  urls_amigables2($fila["submenu_titulo"]);
				$fila["titulo"] = (strlen($fila["titulo"]) > 63) ? substr($fila["titulo"],0,60).'...' : $fila["titulo"];
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
		
	public function getLastFourFromSubmenu ($submenu_id){
        $query = "SELECT id, titulo, subtitulo, descripcion, pathFoto, 
				filenameFoto, vistas, submenu_id, estadoItem_id, fechaNota , autor, video, imagenpor 
				FROM notas WHERE submenu_id = $submenu_id and fechaNota<NOW() ORDER BY notas.fechaNota DESC LIMIT 4";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
				$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }
	
     public function getAllDiez($submenu_id, $id_excluido){
        $query = "SELECT id, titulo, subtitulo, descripcion, pathFoto, filenameFoto, vistas, submenu_id, estadoItem_id, fechaNota , autor, video, imagenpor FROM notas WHERE id<>$id_excluido AND submenu_id = $submenu_id and fechaNota<NOW() ORDER BY notas.fechaNota DESC LIMIT 10";
        $notas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $notas[] = $fila;
            }
            $result->free();
        }
        return $notas;
    }

    public function get($notaId){
        $id = (int) $this->connection->real_escape_string($notaId);
        $query = "SELECT notas.id as id, notas.titulo as titulo, notas.subtitulo as subtitulo, 
					notas.descripcion as descripcion, notas.pathFoto as pathFoto, notas.filenameFoto as filenameFoto, 
					notas.vistas as vistas, notas.submenu_id as submenu_id, notas.estadoItem_id as estadoItem_id, 
					notas.carrusel as carrusel, notas.word as word, notas.video as video, notas.imagenpor as imagenpor, 
					submenu.word as habilitadoWord, menu.titulo as tituloMenu, submenu.id as submenu_id, 
					menu.id as menu_id, submenu.titulo as tituloSubmenu, notas.fechaNota as fechaNota, 
					DATE_FORMAT(fechaNota,'%d-%m-%Y') as fechaNotaUser, DATE_FORMAT(fechaNota,'%H:%i') as horaNotaUser, 
					notas.autor, 					
					bt.status as twitter_status,
					bt.ennota as twitter_ennota,
					bt.enhome as twitter_enhome,
					bt.conversation as twitter_conversation,
					bt.cards as twitter_cards,
					bt.is_active as twitter,					
					IF(submenu.fecha=1,submenu.fecha,NULL) as fechavisible 
					FROM notas 
					LEFT JOIN blog_twitter bt ON bt.nota_id = notas.id
					inner join submenu ON submenu.id=notas.submenu_id 
					inner join menu ON submenu.menu_id= menu.id  
					WHERE notas.id = $notaId AND (bt.is_active = 1 OR bt.is_active IS NULL)";
					
        $r = $this->connection->query($query);
        $fila = $r->fetch_assoc();
		if ($fila){
			$fila["titulo_ami"] =  urls_amigables2($fila["titulo"]);
			$fila["tituloMenu_ami"] =  urls_amigables2($fila["tituloMenu"]);
			$fila["tituloSubmenu_ami"] =  urls_amigables2($fila["tituloSubmenu"]);
		}
		return $fila;
    }
    
 
    public function create($nota){
	$submenu_id = $this->connection->real_escape_string($nota['submenu_id']);
    $titulo = $this->connection->real_escape_string($nota['titulo']);        
    $subtitulo = $this->connection->real_escape_string($nota['subtitulo']);
    $descripcion = $this->connection->real_escape_string($nota['descripcion']);
	$pathFoto = $nota['pathFoto'];
    $filenameFoto = $nota['filenameFoto'];
	$vistas =  (int) $this->connection->real_escape_string($nota['vistas']);
	$estadoItem_id =  (int) $this->connection->real_escape_string($nota['estadoItem_id']);	
	$carrusel = $this->connection->real_escape_string($nota['carrusel']) === 'true' ? '1': '0';
	$word = $this->connection->real_escape_string($nota['word']) === 'true' ? '1': '0';
    $fechaNota = $nota['fechaNota'];
	$autor = $this->connection->real_escape_string($nota['autor']);
	
	$twitter = $this->connection->real_escape_string($nota['twitter']);
	$status = $this->connection->real_escape_string($nota['status']);
	$ennota = $this->connection->real_escape_string($nota['ennota']) === 'true' ? '1': '0';
	$enhome = $this->connection->real_escape_string($nota['enhome']) === 'true' ? '1': '0';
	$ennota = $this->connection->real_escape_string($nota['ennota']) === 'true' ? '1': '0';
	$cards = $this->connection->real_escape_string($nota['cards']) === 'true' ? '1': '0';
    $conversation = $this->connection->real_escape_string($nota['conversation']) === 'true' ? '1': '0';
	
	$video = $this->connection->real_escape_string($nota['video']);
	$imagenpor = $this->connection->real_escape_string($nota['imagenpor']);
	
		try {
			
			$this->connection->autocommit(FALSE);	
			$query = "INSERT INTO notas VALUES (
						DEFAULT,
						'$titulo',
						'$subtitulo',
						'$descripcion',
						'$pathFoto',
				'$filenameFoto',
				'$vistas',
						'$submenu_id',
				'$estadoItem_id',
				'$carrusel',
				'$fechaNota',
				'$word',
				'$autor',
				'$video',
				'$imagenpor'
				)";
			if($this->connection->query($query)){            
				$nota['id'] = $this->connection->insert_id;
				$nota_id = $nota['id'];
				$now = date("Y-m-d H:i:s");
				if ($twitter) {
					$query2 = "INSERT INTO blog_twitter VALUES (
						DEFAULT,
						'$nota_id',
						'$status',
						'$ennota',
						'$enhome',
						'$conversation',
						'$cards',
						'$now',
						'1'
						)";
				
					if(!$this->connection->query($query2)){			  
						throw new Exception('Wrong SQL: ' . $query2 . ' Error: ' . $this->connection->error);
					}
				}
			}else{
				throw new Exception('Wrong SQL: No se puedo agregar Nota');
			}
			
			
			$this->connection->commit();
			$this->connection->autocommit(TRUE);
			return $nota;
			
		} catch (Exception $e) {		 
			
			$this->connection->rollback();
			$this->connection->autocommit(TRUE);
			return false;
			//return $e->getMessage();
		}
	}

	public function eliminarDelCarrusel($nota){	
        $id = (int) $this->connection->real_escape_string($nota['id']);
        
    
        $query = "UPDATE notas SET
					carrusel = '0'
                  WHERE id = $id";
				  
        return $this->connection->query($query);
    }
	
	public function agregarAlCarrusel($nota){	
        $id = (int) $this->connection->real_escape_string($nota['id']);
        
    
        $query = "UPDATE notas SET
					carrusel = '1'
                  WHERE id = $id";
				  
        return $this->connection->query($query);
    }
	
	
    public function update($nota){	
        $id = (int) $this->connection->real_escape_string($nota['id']);
        $submenu_id = $this->connection->real_escape_string($nota['submenu_id']);
        $titulo = $this->connection->real_escape_string($nota['titulo']);        
        $subtitulo = $this->connection->real_escape_string($nota['subtitulo']);
        $descripcion = $this->connection->real_escape_string($nota['descripcion']);
	$pathFoto = $nota['pathFoto'];
        $filenameFoto = $nota['filenameFoto'];
	$vistas =  (int) $this->connection->real_escape_string($nota['vistas']);
	$estadoItem_id =  (int) $this->connection->real_escape_string($nota['estadoItem_id']);
    $carrusel = $this->connection->real_escape_string($nota['carrusel']) === 'true' ? '1': '0';
	$word = $this->connection->real_escape_string($nota['word']) === 'true' ? '1': '0';
	$fechaNota = $nota['fechaNota'];
	$autor = $this->connection->real_escape_string($nota['autor']);
	
	$twitter = $this->connection->real_escape_string($nota['twitter']);
	$status = $this->connection->real_escape_string($nota['status']);
	$ennota = $this->connection->real_escape_string($nota['ennota']) === 'true' ? '1': '0';
	$enhome = $this->connection->real_escape_string($nota['enhome']) === 'true' ? '1': '0';
	$ennota = $this->connection->real_escape_string($nota['ennota']) === 'true' ? '1': '0';
	$cards = $this->connection->real_escape_string($nota['cards']) === 'true' ? '1': '0';
    $conversation = $this->connection->real_escape_string($nota['conversation']) === 'true' ? '1': '0';
	
	$video = $this->connection->real_escape_string($nota['video']);
	$imagenpor = $this->connection->real_escape_string($nota['imagenpor']);
	
	try {
			
			$this->connection->autocommit(FALSE);	
			$query = "UPDATE notas SET
					submenu_id = '$submenu_id',
                    titulo = '$titulo',
                    subtitulo = '$subtitulo',
                    descripcion = '$descripcion',
					pathFoto = '$pathFoto',
                    filenameFoto = '$filenameFoto',
		    vistas = '$vistas',
		    estadoItem_id = '$estadoItem_id',
			carrusel = '$carrusel',
			fechaNota = '$fechaNota',
			word = '$word',
			autor = '$autor',
			video = '$video',
			imagenpor = '$imagenpor'
                  WHERE id = $id";
			
			if($this->connection->query($query)){            				
				$nota_id = $id;
				$now = date("Y-m-d H:i:s");
				
				$query1 = "UPDATE blog_twitter SET is_active=0 WHERE nota_id='$nota_id'";
				if(!$this->connection->query($query1)){			  
					throw new Exception('Wrong SQL: ' . $query1 . ' Error: ' . $this->connection->error);
				}

				if ($twitter) {
					$query2 = "INSERT INTO blog_twitter VALUES (
						DEFAULT,
						'$nota_id',
						'$status',
						'$ennota',
						'$enhome',
						'$conversation',
						'$cards',
						'$now',
						'1'
						)";
				
					if(!$this->connection->query($query2)){			  
						throw new Exception('Wrong SQL: ' . $query2 . ' Error: ' . $this->connection->error);
					}
				}
				
			}else{
				throw new Exception('Wrong SQL: No se puedo actualizar Nota');
			}
		
		
			$this->connection->commit();
			$this->connection->autocommit(TRUE);
			return true;
		
		} catch (Exception $e) {		 
			
			$this->connection->rollback();
			$this->connection->autocommit(TRUE);
			return false;
			//return $e->getMessage();
		}
    }

	 public function updateFecha($id, $fecha){           
        $query = "UPDATE notas SET fechaNota = '$fecha' WHERE id = $id";
        return $this->connection->query($query);
    }

	
    public function remove($notaId){
        $id = (int) $this->connection->real_escape_string($notaId);
        $query = "DELETE FROM notas
                  WHERE id = $id";
        return $this->connection->query($query);
    }
}