<?php
require_once("Koneksi.php");
class ModelJabatan extends Koneksi
   {

      function select()
      {
         try {
            return mysqli_query($this->conn,"SELECT * from jabatan");        
         } catch (Exception $e) {
            return mysqli_connect_error(); 
         }

      }
   }

?>