<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{

	public $parent_modul = 'Pengaturan';
	public $title = 'Pengaturan';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
		if (cekParentModul($this->parent_modul) == FALSE) redirect('panel/dashboard');
		$this->akses_controller = $this->uri->segment(3);
	}

	public function identitasAplikasi($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$identitasAplikasi = array(
				'apps_name' => $this->input->post('apps_name'),
				'apps_version' => $this->input->post('apps_version'),
				'apps_code' => $this->input->post('apps_code'),
				'agency' => $this->input->post('agency'),
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'telephon' => $this->input->post('telephon'),
				'fax' => $this->input->post('fax'),
				'website' => $this->input->post('website'),
				'header' => $this->input->post('header'),
				'footer' => $this->input->post('footer'),
				'keyword' => $this->input->post('keyword'),
				'about_us' => $this->input->post('about_us'),
				'saran_informasi' => $this->input->post('saran_informasi'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'instagram' => $this->input->post('instagram'),
				'email' => $this->input->post('email')
			);
			//---------------- UPDATE LOGO ---------------//
			$config['upload_path']          = 'assets/img/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 10000;


			$this->upload->initialize($config);
			$getIdentitas = $this->GeneralModel->get_general('at_identitas');
			if (!$this->upload->do_upload('logo')) {
			} else {
				if (!empty($getIdentitas[0]->logo)) {
					unlink($getIdentitas[0]->logo);
				}
				$identitasAplikasi += array('logo' => $config['upload_path'] . $this->upload->data('file_name'));
			}

			//---------------- UPDATE ICON ---------------//
			$config['upload_path']          = 'assets/img/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|ico';
			$config['max_size']             = 10000;


			$this->upload->initialize($config);

			if (!$this->upload->do_upload('icon')) {
			} else {
				if (!empty($getIdentitas[0]->icon)) {
					unlink($getIdentitas[0]->icon);
				}
				$identitasAplikasi += array('icon' => $config['upload_path'] . $this->upload->data('file_name'));
			}

			//---------------- UPDATE SIDEBAR LOGIN ---------------//
			$config['upload_path']          = 'assets/img/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|ico';
			$config['max_size']             = 10000;


			$this->upload->initialize($config);

			if (!$this->upload->do_upload('sidebar_login')) {
			} else {
				if (!empty($getIdentitas[0]->sidebar_login)) {
					unlink($getIdentitas[0]->sidebar_login);
				}
				$identitasAplikasi += array('sidebar_login' => $config['upload_path'] . $this->upload->data('file_name'));
			}

			if ($this->GeneralModel->update_general('at_identitas', 'id_profile', 1, $identitasAplikasi) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data identitas aplikasi berhasil diupdate</div>');
				redirect(changeLink('panel/pengaturan/identitasAplikasi'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data identitas aplikasi berhasil diupdate</div>');
				redirect(changeLink('panel/pengaturan/identitasAplikasi'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Aplikasi';
			$data['content'] = 'panel/pengaturan/identitas/update';
			$data['identitas'] = $this->GeneralModel->get_by_id_general('at_identitas','id_profile',1);
			$this->load->view('panel/content', $data);
		}
	}

	public function daftarModul()
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Daftar Modul';
		$data['content'] = 'panel/pengaturan/modulMenu/index';
		$data['parentModul'] = $this->GeneralModel->get_general_order_by('at_parent_modul', 'urutan', 'ASC');
		$this->load->view('panel/content', $data);
	}

	public function metodePembayaran($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			return $this->SettingsModel->getMetodePembayaran();		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Metode Pembayaran';
			$data['content'] = 'panel/pengaturan/metodePembayaran/index';
			$this->load->view('panel/content', $data);
		}
	}

	public function createMetodePembayaran($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Tambah Metode Pembayaran';
		$data['content'] = 'panel/pengaturan/metodePembayaran/create';
		if ($param1=='doCreate') {
			//---------- VALIDATION -------------//
			$this->form_validation->set_rules(
					'payment_method', 'Metode Pembayaran',
					'required|is_unique[at_payment_method.payment_method]',
					array(
							'required'      => 'Metode Pembayaran tidak boleh kosong',
							'is_unique'     => 'Metode Pembayaran tidak dapat ditambahkan karena sudah pernah digunakan'
					),
					'payment_method_name', 'Nama Metode Pembayaran',
					'required',
					array(
							'required'      => 'Nama Metode Pembayaran tidak boleh kosong',
					)
			);
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('panel/content', $data);
			}else{
				$dataMetodePembayaran = array(
					'payment_method' => strtoupper($this->input->post('payment_method')),
					'payment_method_name' => $this->input->post('payment_method_name'),
				);
				if($this->GeneralModel->create_general('at_payment_method',$dataMetodePembayaran)==true){
					$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Metode Pembayaran berhasil ditambah</div>');
					redirect(changeLink('panel/pengaturan/metodePembayaran/'));
				}else{
					$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Metode Pembayaran gagal ditambah</div>');
					redirect(changeLink('panel/pengaturan/metodePembayaran/'));
				}
			}
		}else{
			$this->load->view('panel/content', $data);
		}
	}

	public function updateMetodePembayaran($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$dataMetodePembayaran = array(
				'payment_method' => strtoupper($this->input->post('payment_method')),
				'payment_method_name' => $this->input->post('payment_method_name'),
			);
			if($this->GeneralModel->update_general('at_payment_method','id_payment_method',$param2,$dataMetodePembayaran)==true){
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Metode Pembayaran berhasil diupdate</div>');
				redirect(changeLink('panel/pengaturan/metodePembayaran/'));
			}else{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Metode Pembayaran gagal diupdate</div>');
				redirect(changeLink('panel/pengaturan/metodePembayaran/'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Metode Pembayaran';
			$data['content'] = 'panel/pengaturan/metodePembayaran/update';
			$data['metodePembayaran'] = $this->GeneralModel->get_by_id_general('at_payment_method','id_payment_method',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteMetodePembayaran($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$this->GeneralModel->delete_general('at_payment_method','id_payment_method',$param1);
		$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Metode Pembayaran berhasil dihapus</div>');
		redirect(changeLink('panel/pengaturan/metodePembayaran/'));
	}

	public function channelPembayaran($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			return $this->SettingsModel->getChannelPembayaran();		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Channel Pembayaran';
			$data['content'] = 'panel/pengaturan/channelPembayaran/index';
			$this->load->view('panel/content', $data);
		}
	}

	public function createChannelPembayaran($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Tambah Channel Pembayaran';
		$data['content'] = 'panel/pengaturan/channelPembayaran/create';
		$data['metodePembayaran'] = $this->GeneralModel->get_general('at_payment_method');
		if ($param1=='doCreate') {
			$dataChannelPembayaran = array(
				'payment_channel' => $this->input->post('payment_channel'),
				'nama_payment_channel' => $this->input->post('nama_payment_channel'),
				'payment_method' => $this->input->post('payment_method'),
				'payment_type' => $this->input->post('payment_type'),
				'no_rekening' => $this->input->post('no_rekening'),
				'an_rekening' => $this->input->post('an_rekening'),
			);
			if($this->GeneralModel->create_general('at_payment_channel',$dataChannelPembayaran)==true){
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Channel Pembayaran berhasil ditambah</div>');
				redirect(changeLink('panel/pengaturan/channelPembayaran/'));
			}else{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Channel Pembayaran gagal ditambah</div>');
				redirect(changeLink('panel/pengaturan/channelPembayaran/'));
			}
		}else{
			$this->load->view('panel/content', $data);
		}
	}

	public function updateChannelPembayaran($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$dataChannelPembayaran = array(
				'payment_channel' => $this->input->post('payment_channel'),
				'nama_payment_channel' => $this->input->post('nama_payment_channel'),
				'payment_method' => $this->input->post('payment_method'),
				'payment_type' => $this->input->post('payment_type'),
				'no_rekening' => $this->input->post('no_rekening'),
				'an_rekening' => $this->input->post('an_rekening'),
			);
			if($this->GeneralModel->update_general('at_payment_channel','id_payment_channel',$param2,$dataChannelPembayaran)==true){
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Channel Pembayaran berhasil diupdate</div>');
				redirect(changeLink('panel/pengaturan/channelPembayaran/'));
			}else{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Metode Pembayaran gagal diupdate</div>');
				redirect(changeLink('panel/pengaturan/channelPembayaran/'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Metode Pembayaran';
			$data['content'] = 'panel/pengaturan/channelPembayaran/update';
			$data['metodePembayaran'] = $this->GeneralModel->get_general('at_payment_method');
			$data['channelPembayaran'] = $this->GeneralModel->get_by_id_general('at_payment_channel','id_payment_channel',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteChannelPembayaran($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$this->GeneralModel->delete_general('at_payment_channel','id_payment_channel',$param1);
		$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Channel Pembayaran berhasil dihapus</div>');
		redirect(changeLink('panel/pengaturan/channelPembayaran/'));
	}
}
