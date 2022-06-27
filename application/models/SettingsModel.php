<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingsModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_profile()
    {
        $query = $this->db->where('id_profile', '1')->get('at_identitas');
        return $query->row();
    }

    public function getMetodePembayaran(){
        $this->datatables->select('*,at_payment_method.id_payment_method as id_payment_method');
        $this->datatables->from('at_payment_method');
        $this->datatables->add_column(
            'action',
            anchor(changeLink('panel/pengaturan/updateMetodePembayaran/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
            . anchor(changeLink('panel/pengaturan/deleteMetodePembayaran/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus metode pembayaran?')")),
            'id_payment_method'
            );
        return print_r($this->datatables->generate('json'));
    }

    public function getChannelPembayaran(){
        $this->datatables->select('*,at_payment_channel.id_payment_channel as id_payment_channel');
        $this->datatables->from('at_payment_channel');
        $this->datatables->add_column(
            'action',
            anchor(changeLink('panel/pengaturan/updateChannelPembayaran/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
            . anchor(changeLink('panel/pengaturan/deleteChannelPembayaran/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus channel pembayaran?')")),
            'id_payment_channel'
            );
        return print_r($this->datatables->generate('json'));
    }

  
}
