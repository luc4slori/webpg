<?php
require_once("connection.php");

class Lectura
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
    
    public function getAll(){
        $query = "SELECT id, nota_id, user_id FROM lecturas ORDER BY id ASC";
        $Lecturas = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $Lecturas[] = $fila;
            }
            $result->free();
        }
        return $Lecturas;
    }

    public function get($LecturaId){
        $id = (int) $this->connection->real_escape_string($LecturaId);
        $query = "SELECT id, nota_id, user_id FROM lecturas WHERE id = $id";
        $r = $this->connection->query($query);
        return $r->fetch_assoc();
    }
	
	public function getPorIdNotaIdUser($NotaId, $UserId){
        $nota_id = (int) $this->connection->real_escape_string($NotaId);
		$user_id = (int) $this->connection->real_escape_string($UserId);
        $query = "SELECT id, nota_id, user_id FROM lecturas WHERE nota_id = $nota_id AND user_id= $user_id";
        $r = $this->connection->query($query);
        return $r->fetch_assoc();
    }    
      
    public function create($Lectura){
        $user_id = (int) $this->connection->real_escape_string($Lectura['user_id']);	
	$nota_id = (int) $this->connection->real_escape_string($Lectura['nota_id']);	
		
        $query = "INSERT INTO lecturas VALUES (
                    DEFAULT,
                    '$user_id',
	            '$nota_id'
		    )";
      
         
        
        if($this->connection->query($query)){            
            $Lectura['id'] = $this->connection->insert_id;
            return $Lectura;
        }else{
            return false;
        }
        
       
    }

    public function update($Lectura){	
        $id = (int) $this->connection->real_escape_string($Lectura['id']);      
        $user_id = $this->connection->real_escape_string($Lectura['user_id']);	
		$nota_id = $this->connection->real_escape_string($Lectura['nota_id']);	
		
        $query = "UPDATE lecturas SET					                                       
                    user_id = '$user_id',
					nota_id = '$nota_id'
                  WHERE id = $id";
        return $this->connection->query($query);
    }

    public function remove($LecturaId){
        $id = (int) $this->connection->real_escape_string($LecturaId);
        $query = "DELETE FROM lecturas
                  WHERE id = $id";
        return $this->connection->query($query);
    }
}