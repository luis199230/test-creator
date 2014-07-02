<?php
class Database{
    private static $dbself = null;
    private $link;  
    private $host;
    private $bd;
    private $user;
    private $pass;
    private $message;        
    
    private function __construct(){
        $this->host = "localhost";
        $this->bd = "examenes";
        $this->user = "root";
        $this->pass = "madeweb";
    }
     
    public static function get_instance(){   // aqui aplicamos singleton
        if( !self::$dbself instanceof self ){
            self::$dbself = new self;
        }
        return self::$dbself;
    }
        
    public function conectar(){
        $conexion = mysql_connect
        (
            $this->host,
            $this->user,
            $this->pass
        );
 
        if(!is_resource($conexion))
        {
            $this->message = "ERROR: No se puede conectar a la base de datos..!";
            throw new Exception($this->message);
            die;
        }
         
        $this->link = $conexion;
        $existbd  =  mysql_select_db($this->bd, $conexion);
        if(!$existbd){
            $this->_sMensaje = "ERROR: No se puede usar la base de datos..!";
            throw new Exception($this->message);
            die;
        }else{
            mysql_set_charset('utf8',$this->link);
        }
        return true;
    }
 
    public function get_link_id(){
        return $this->link;
    }        
}
?>