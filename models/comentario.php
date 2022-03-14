<?php
require("connection.php");

class Comentario
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
    
    public function getAll(){
        $query = "SELECT id, user_id, nota_id, descripcion FROM comentarios";
        $comentarios = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $comentarios[] = $fila;
            }
            $result->free();
        }
        return $comentarios;
    }

    public function get($comentarioId){
        $id = (int) $this->connection->real_escape_string($comentarioId);
        $query = "SELECT id, user_id, nota_id, descripcion FROM comentarios WHERE id = $comentarioId and estadoItem_id=1";
        $r = $this->connection->query($query);
        return $r->fetch_assoc();
    }
    
    public function getPorIdNota($notaId){
        $idNota = (int) $this->connection->real_escape_string($notaId);
        $query = "SELECT comentarios.id as id, user_id, apellido, nombre, belong, descripcion, TIMESTAMPDIFF(YEAR,fecha,NOW()) as anios, TIMESTAMPDIFF(MONTH,fecha,NOW()) as meses, TIMESTAMPDIFF(DAY,fecha,NOW()) as dias, TIMESTAMPDIFF(HOUR,fecha,NOW()) as horas, TIMESTAMPDIFF(MINUTE,fecha,NOW()) as minutos, TIMESTAMPDIFF(SECOND,fecha,NOW()) as segundos FROM comentarios inner join users on users.id = comentarios.user_id WHERE nota_id = '$idNota' AND comentarios.estadoItem_id='1' ORDER BY comentarios.id DESC";
        $comentarios = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $comentarios[] = $fila;
            }
            $result->free();
        }
        return $comentarios;
    }
    
    public function create($comentario){
        $user_id = $this->connection->real_escape_string($comentario['user_id']);
        $nota_id = $this->connection->real_escape_string($comentario['nota_id']);
		$descripcion = $this->connection->real_escape_string($comentario['descripcion']);
        
        
        $query = "INSERT INTO comentarios VALUES (
                    DEFAULT,
                    '$user_id',
                    '$nota_id',
                    '$descripcion',
					DEFAULT, DEFAULT)";
        
        if($this->connection->query($query)){
            $comentario['id'] = $this->connection->insert_id;
            return $comentario;
        }else{
            return false;
        }
    }

    public function update($comentario){
        $id = (int) $this->connection->real_escape_string($comentario['id']);
        $user_id = (int) $this->connection->real_escape_string($comentario['user_id']);
        $nota_id = (int) $this->connection->real_escape_string($comentario['nota_id']);
		$descripcion = $this->connection->real_escape_string($comentario['descripcion']);
		$estadoItem_id = (int) $this->connection->real_escape_string($comentario['estadoItem_id']);
        
        
        $query = "UPDATE comentarios SET
                    user_id = '$user_id',
                    nota_id = '$nota_id',
					descripcion = '$descripcion',
                    passw = '$passw',
                    email = '$email',
					estadoItem_id = '$estadoItem_id'
                  WHERE id = $id";
        return $this->connection->query($query);
    }

    public function remove($comentarioId){
        $id = (int) $this->connection->real_escape_string($comentarioId);
        $query = "DELETE FROM users
                  WHERE id = $id";
        return $this->connection->query($query);
    }
	
	public function removeView($idComment){
		$id = (int) $this->connection->real_escape_string($idComment);
		$query = "UPDATE comentarios SET
					estadoItem_id = 2
                  WHERE id = $id";
		return $this->connection->query($query);
	}
	
}