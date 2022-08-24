<?php
require_once("Koneksi.php");
class ModelDivisi extends Koneksi
   {
      function select()
      {
         try {
            return mysqli_query($this->conn,"SELECT * from divisi");        
         } catch (Exception $e) {
            return mysqli_connect_error(); 
         }

      }
   }

?>