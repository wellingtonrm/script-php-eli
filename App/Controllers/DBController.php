<?php 
namespace App\Controllers;




class DBController{
    private $user;
    private $password;
    private $database;
    private $host; 


    public function __construct() {
        $this->user = 'root';
        $this->password = '';
        $this->database ='teste';
        $this->host = 'localhost';
        $this->Conectar = new \MySQLi($this->host, $this->user, $this->password, $this->database);
    }

   
    public function FecharBanco() {
        $this->Conectar->close();
    }
    public function createSQL($sql) {
      
        $this->result  = $this->Conectar->query($sql);
        
        return $this->result;
    }

    public function findSQL($sql) {
      
        $this->result  = $result = mysqli_query($this->Conectar, $sql);
        $result_check = mysqli_num_rows($this->result);
        if($result_check > 0){
        $users = mysqli_fetch_all($this->result, MYSQLI_ASSOC);
          return $users;
        }else{
            return [];
        }
        
      
        
    }
   
}
?>