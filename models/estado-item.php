<?php
require("connection.php");

class EstadoItem
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
		
    public function getAll(){
        $query = "SELECT id, descripcion FROM estadoItem ORDER BY id ASC";
        $EstadosItems = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $EstadosItems[] = $fila;
            }
            $result->free();
        }
        return $EstadosItems;
    }

    public function get($EstadoItemId){
        $id = (int) $this->connection->real_escape_string($EstadoItemId);
        $query = "SELECT id, descripcion FROM estadoItem WHERE id = $EstadoItemId";
        $r = $this->connection->query($query);
        return $r->fetch_assoc();
    }

 
}