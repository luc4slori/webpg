<?php
require("connection.php");

class User
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
    
    public function getEmail($userEmail, $userBelong){       
		$email = $this->connection->real_escape_string($userEmail);
		$belong = $this->connection->real_escape_string($userBelong);
		$query = "SELECT users.id, users.nombre, users.apellido, users.telefono, users.passw, users.email, users.hash, users.fechanac, users.imagen, users.permiso_id, permisos.descripcion as tipo , users.estadoCuenta_id, users.deseo, users.belong FROM users inner join permisos on users.permiso_id = permisos.id WHERE email = '$email' AND belong = '$belong' ";
		$r = $this->connection->query($query);
		return $r->fetch_assoc();
    }
    
    
    public function getAll(){
        $query = "SELECT id, nombre, apellido, telefono, passw, email, hash, fechanac, imagen, permiso_id, estadoCuenta_id, deseo, belong FROM users";
        $users = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $users[] = $fila;
            }
            $result->free();
        }
        return $users;
    }

    public function get($userId){
        $id = (int) $this->connection->real_escape_string($userId);
        $query = "SELECT id, nombre, apellido, telefono, passw, email, hash, fechanac, imagen, permiso_id, estadoCuenta_id, deseo, belong FROM users WHERE id = $userId";
        $r = $this->connection->query($query);
        return $r->fetch_assoc();
    }
    
	public function getLogin($userEmail, $userPassw, $userBelong){
        $email = $this->connection->real_escape_string($userEmail);		
		$passw = $this->connection->real_escape_string($userPassw);
		$belong = $this->connection->real_escape_string($userBelong);
		
        $query = "SELECT users.id, nombre, apellido, telefono, passw, email, hash, fechanac, imagen, estadoCuenta.descripcion as estado, permisos.descripcion as tipo, deseo, belong FROM users inner join estadoCuenta on users.estadoCuenta_id = estadoCuenta.id inner join permisos on users.permiso_id = permisos.id WHERE email = '$email' and passw= '$passw' and belong= '$belong' ";
        $r = $this->connection->query($query);
        return $r->fetch_assoc();
    }
    
	public function getConfirmation($userEmail, $userHash){       
	$email = $this->connection->real_escape_string($userEmail);
	$hash = $this->connection->real_escape_string($userHash);
        $query = "SELECT id, nombre, apellido, telefono, passw, email, hash, fechanac, imagen, permiso_id, estadoCuenta_id, deseo, belong FROM users WHERE email = '$email' AND hash = '$hash' ";
        $r = $this->connection->query($query);
        return $r->fetch_assoc();
    }
	 public function setConfirmation($user){
        $id = (int) $this->connection->real_escape_string($user['id']);
      	$estadoCuenta_id =  2;
	        
        $query = "UPDATE users SET                    
		    estadoCuenta_id = '$estadoCuenta_id'
                  WHERE id = $id";
        return $this->connection->query($query);
    }
    
    public function create($user){
	
        $nombre = $this->connection->real_escape_string($user['nombre']);
        $apellido = $this->connection->real_escape_string($user['apellido']);		
        $passw = $this->connection->real_escape_string($user['passw']);
        $email = $this->connection->real_escape_string($user['email']);
		$telefono = $this->connection->real_escape_string($user['telefono']);
		$hash = $this->connection->real_escape_string($user['hash']);
		$imagen = $this->connection->real_escape_string($user['imagen']);
		$fechanac = $this->connection->real_escape_string($user['fechanac']);
		$deseo = (int) $this->connection->real_escape_string($user['deseo']);
		$belong = $this->connection->real_escape_string($user['belong']);
	        
        $query = "INSERT INTO users VALUES (
                    DEFAULT,
                    '$nombre',
                    '$apellido',
		    '$passw',
                    '$email',
		    '$telefono',
		    '$hash',
		    '$fechanac',
		    '$imagen',
		    DEFAULT,
		    DEFAULT,
		    '$deseo',
			'$belong')";
        
        if($this->connection->query($query)){
            $user['id'] = $this->connection->insert_id;
            return $user;
        }else{
            return false;
        }
    }

    public function update($user){
        $id = (int) $this->connection->real_escape_string($user['id']);
        $nombre = $this->connection->real_escape_string($user['nombre']);
        $apellido = $this->connection->real_escape_string($user['apellido']);
        $passw =  $this->connection->real_escape_string($user['passw']);
        $email =  $this->connection->real_escape_string($user['email']);
	$telefono = $this->connection->real_escape_string($user['telefono']);
	$estadoCuenta_id =  $this->connection->real_escape_string($user['estadoCuenta_id']);
	/*$hash = $this->connection->real_escape_string($user['hash']);*/
	$permiso_id =  $this->connection->real_escape_string($user['permiso_id']);
	/*$imagen = $this->connection->real_escape_string($user['imagen']);*/
	$fechanac = $this->connection->real_escape_string($user['fechanac']);
	$deseo = (int) $this->connection->real_escape_string($user['deseo']);
        
        /*( imagen y hash ) no los pongo en la query update*/
        $query = "UPDATE users SET
                    nombre = '$nombre',
                    apellido = '$apellido',		
                    passw = '$passw',
                    email = '$email',
		    telefono = '$telefono',		    
		    fechanac = '$fechanac',
		    deseo = '$deseo',
		    permiso_id = '$permiso_id',
		    estadoCuenta_id = '$estadoCuenta_id'
                  WHERE id = $id";
        return $this->connection->query($query);
    }

    public function remove($userId){
        $id = (int) $this->connection->real_escape_string($userId);
        $query = "DELETE FROM users
                  WHERE id = $id";
        return $this->connection->query($query);
    }
}