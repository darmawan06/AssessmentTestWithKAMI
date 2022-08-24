<?php 
    require_once("Koneksi.php");
	class ModelPegawai extends Koneksi 
	{

      function routes($method){
         if ($method == 'add') {
            $name = $this->validatePOST('name');
            $gender = $this->validatePOST('gender');
            $numberphone = $this->validatePOST('numberphone');
            $email = $this->validatePOST('email');
            $address = $this->validatePOST('address');
            $jabatan = $this->validatePOST('jabatan');
            $divisi = $this->validatePOST('divisi');
            $this->insert(null,$name,$numberphone,$email,$address,$gender,$jabatan,$divisi);
         }elseif($method == 'delete'){
            $this->delete($this->validateGET('id_pegawai'));
         }elseif($method == 'update'){
            $id_pegawai = $this->validateGET('id_pegawai');
            $name = $this->validatePOST('name');
            $gender = $this->validatePOST('gender');
            $numberphone = $this->validatePOST('numberphone');
            $email = $this->validatePOST('email');
            $address = $this->validatePOST('address');
            $jabatan = $this->validatePOST('jabatan');
            $divisi = $this->validatePOST('divisi');
            $this->update($id_pegawai,$name,$numberphone,$email,$address,$gender,$jabatan,$divisi);
         }
      }

      function select()
      {
         try {
            return mysqli_query($this->conn,"SELECT * from pegawai");        
         } catch (Exception $e) {
            return mysqli_connect_error(); 
         }

      }
      function selectJoin(){
         try {
            return mysqli_query($this->conn,"SELECT `pegawai`.*, `jabatan`.`nama_jabatan`, `divisi`.`nama_divisi`,`gaji`.`nominal_gaji` FROM `pegawai`,`jabatan`,`divisi`,`gaji` WHERE `jabatan`.`id_jabatan` = `pegawai`.`jabatan` && `divisi`.`id_divisi` = `pegawai`.`divisi` && `jabatan`.`id_gaji` = `gaji`.`id_gaji`");       
         } catch (Exception $e) {
            return mysqli_connect_error(); 
         }
      }

      function find($id_pegawai){
         try{
            return mysqli_query($this->conn,"SELECT * FROM `pegawai` WHERE `id_pegawai` = {$id_pegawai}");
         }catch(Exception $e){
            return mysqli_connect_error();
         }
      }

      function insert($id_pegawai, $nama_pegawai, $telepon_pegawai, $email, $alamat, $jenis_kelamin, $jabatan, $divisi){
         try {
            return mysqli_query($this->conn,"INSERT INTO `pegawai`(`id_pegawai`, `nama_pegawai`, `telepon_pegawai`, `email`, `alamat`, `jenis_kelamin`, `jabatan`, `divisi`) VALUES ('{$id_pegawai}','{$nama_pegawai}','{$telepon_pegawai}','{$email}','{$alamat}','{$jenis_kelamin}','{$jabatan}','{$divisi}')");        
         } catch (Exception $e) {
            return mysqli_connect_error(); 
         } 
      }

      function delete($id_pegawai){
         try{
            return mysqli_query($this->conn,"DELETE FROM `pegawai` WHERE `pegawai`.`id_pegawai` = {$id_pegawai}");
         }catch(Exception $e){
            return mysqli_connect_error();
         }
      }

      function update($id_pegawai, $nama_pegawai, $telepon_pegawai, $email, $alamat, $jenis_kelamin, $jabatan, $divisi){
         try{
            return mysqli_query($this->conn,"UPDATE `pegawai` SET `nama_pegawai` = '{$nama_pegawai}', `telepon_pegawai` = '{$telepon_pegawai}', `email` = '{$email}', `alamat` = '{$alamat}', `jenis_kelamin` = '{$jenis_kelamin}', `jabatan` = '{$jabatan}', `divisi` = '{$divisi}' WHERE `pegawai`.`id_pegawai` = {$id_pegawai}; ");
         }catch(Exception $e){
            return mysqli_connect_error();
         }  
      }
	}

   $modelPegawai = new ModelPegawai();
   if(isset($_GET['method'])){
      $modelPegawai->routes($_GET['method']);
      header('location: ./index.php',true,301);
   }

?>