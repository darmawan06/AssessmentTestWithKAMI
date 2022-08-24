<?php
    require_once('ValidateHTTPRequests.php');
    class Koneksi extends ValidateHTTPRequests
    {
        public $severname;
        public $database;
        public $username;
        public $pass;
        public $conn;

        function __construct(){
            $this->severname = "localhost";
            $this->database = "crud_simple_kami";
            $this->username = "root";
            $this->pass = "";
            $this->conn = mysqli_connect($this->severname,$this->username,$this->pass,$this->database);
            if(!$this->conn){
                die("Koneksi Gagal :". mysqli_connect_error());
            }
        }

        function close($conn)
        {
            mysqli_close($conn);
        }
    }
    
?>