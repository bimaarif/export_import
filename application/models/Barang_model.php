<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model
{

   public function import_data($databarang)
   {
       // var_dump($databarang);
       // die();
   	   $jumlah = count($databarang);

   	   if($jumlah > 0){
          $this->db->replace('m_barang', $databarang);
   	   }
   }

   public function getAllDatabarang($tanggalawal = null, $tanggalakhir = null)
   {

   	  $tanggalawalbaru  = strtotime($tanggalawal); 
      $tanggalakhirbaru = strtotime($tanggalakhir);

   	  if ($tanggalawal && $tanggalakhir) {
   	  	  $this->db->where('data_created >=',$tanggalawalbaru);
   	  	  $this->db->where('data_created <=',$tanggalakhirbaru);
   	  }
   	  return $this->db->get('m_barang')->result_array();
   }
    
}	