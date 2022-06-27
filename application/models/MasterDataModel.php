<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterDataModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

    public function getProduk()
  {
    $this->datatables->select('*,at_produk.id_produk as id_produk');
    $this->datatables->from('at_produk');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updateProduk/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deleteProduk/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus produk?')")),
      'id_produk'
    );
    return print_r($this->datatables->generate('json'));
  }

    public function getRiwayat($pengguna='')
  {
    $this->datatables->select('*,v_shop_history.id_shop_history as id_shop_history');
    $this->datatables->from('v_shop_history');
    if (!empty($pengguna)) {
      $this->datatables->where('pengguna',$pengguna);
    }
    return print_r($this->datatables->generate('json'));
  }

    public function getBuyProduk()
  {
    $this->datatables->select('*,at_produk.id_produk as id_produk');
    $this->datatables->from('at_produk');
    $this->datatables->add_column(
      'action', 
        anchor(changeLink('panel/shop/buyProduk/$1'), '<i class="fa fa-money"></i> BUY', array('class' => 'btn btn-primary btn-xs', "onclick" => "return confirm('Are you sure want to buy this item?')")),
      'id_produk'
    );
    return print_r($this->datatables->generate('json'));
  }

    public function getLeaderboard()
  {
    $this->datatables->select('*,v_leaderboard.id_pengguna as id_pengguna');
    $this->datatables->from('v_leaderboard');
    $this->datatables->where('hak_akses = "member"');
    return print_r($this->datatables->generate('json'));
  }


}
