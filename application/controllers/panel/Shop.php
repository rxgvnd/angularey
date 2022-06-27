<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{

	public $parent_modul = 'Shop';
	public $title = 'Shop';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
	}

	public function index(){
		$this->daftarProduk();
	}

	public function daftarProduk($param1=''){
		if ($param1=='cari') {
			return $this->MasterDataModel->getRiwayat($this->session->userdata('id_pengguna'));
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Buy Items';
			$data['content'] = 'panel/shop/index';
			$data['produk'] = $this->GeneralModel->get_general('at_produk');
			$this->load->view('panel/content', $data);
		}
	}

	public function buyProduk($param1=''){
		$getProduk = $this->GeneralModel->get_by_id_general('at_produk','id_produk',$param1);
		if ($getProduk) {
			foreach ($getProduk as $key) {
				if ($key->harga > $this->session->userdata('pizza')) {
					$this->session->set_flashdata("notif","<div class='alert alert-danger'>Sorry you can't buy this item, you'r pizza is not enough</div>");
					redirect('panel/shop/');
				}else{
					$dataPengguna = array(
						'hint' => $key->jumlah_hint + $this->session->userdata('hint'),
						'pizza' => $this->session->userdata('pizza') - $key->harga
					);
					$this->GeneralModel->update_general('at_pengguna','id_pengguna',$this->session->userdata('id_pengguna'),$dataPengguna);
					$this->session->set_userdata($dataPengguna);
					$dataHistory = array(
						'pengguna' => $this->session->userdata('id_pengguna'),
						'jumlah_hint' => $key->jumlah_hint,
						'harga' => $key->harga
					);
					$this->GeneralModel->create_general('at_shop_history',$dataHistory);
					$this->session->set_flashdata("notif","<div class='alert alert-success'>Thank you for buyin this item!</div>");
					redirect('panel/shop/');
				}
			}
		}else{
			$this->session->set_flashdata("notif","<div class='alert alert-danger'>Sorry we can't find item you search..</div>");
			redirect('panel/shop/');
		}
	}


}
