<?php
class Connection extends MySQLi {
     private static $instance = null ;
      const HOST = '127.0.0.1';
     const USER = 'proyectogeocom_pg';
     const PASSWORD = 'F=WNKWMaTV_P';           
	 //const USER = 'root';
     //const PASSWORD = 'chupala';           
     const DATABASE = 'proyectogeocom_pg';
         
     public function __construct($host, $user, $password, $database){ 
         parent::__construct($host, $user, $password, $database);
     }

     public static function getInstance(){
         if (self::$instance == null){
             self::$instance = new self(self::HOST, self::USER, self::PASSWORD, self::DATABASE);
             self::$instance->query("SET NAMES 'utf8'");
         }
         return self::$instance ;
     }
}