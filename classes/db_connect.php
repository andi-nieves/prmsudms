<?php
if(!defined('servername')){
    require_once("../initialize.php");
}
class db_connect{

    private $servername = "localhost";
    private $username = "root";
    private $password = "";

    private $db_name = "PRMSUdms_db";
    
    public $conn;

    public function __construct(){

        if (!isset($this->conn)) {

            $this->conn =new mysqli($this->servername, $this->username, $this->password, $this->db_name);

            if(!$this->conn) {
                echo "Connection Failed";
                exit;
            }
        }
    }
    public function __destruct(){
        $this->conn->close();
    }
}
?>