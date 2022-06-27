<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenggunaModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  public function getHakAkses(){
    return $this->db->query("SELECT ha.* FROM at_hak_akses ha")->result();
  }

  public function getPengguna($hak_akses,$status_pengguna)
  {
    $this->datatables->select('*,at_pengguna.id_pengguna as id_pengguna');
    $this->datatables->from('at_pengguna');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updatePengguna/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deletePengguna/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus pengguna?')")),
      'id_pengguna'
    );
    if (!empty($hak_akses)) {
      $this->datatables->where("hak_akses = '$hak_akses'");
    }
    if ($status_pengguna!='') {
      $this->datatables->where("status_pengguna = '$status_pengguna'");
    }
    return print_r($this->datatables->generate('json'));
  }

  public function cekFriends($id_pengguna,$id_teman){
    return $this->db->query("SELECT * FROM at_friend WHERE (pengguna_1='$id_pengguna' and pengguna_2='$id_teman') OR (pengguna_1='$id_teman' and pengguna_2='$id_pengguna')")->row();
  }

  public function friendList($id_pengguna,$status){
    return $this->db->query("SELECT * FROM v_friend WHERE 
    (pengguna_1='$id_pengguna' OR pengguna_2='$id_pengguna') and konfirmasi='Y'")->result();
  }

  public function friendRequest($id_pengguna){
    return $this->db->query("SELECT * FROM v_friend WHERE pengguna_2='$id_pengguna' and konfirmasi='N'")->result();
  }


}
