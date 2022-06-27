<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $parent_modul = 'Dashboard';
	public $title = 'Dashboard';

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('LoggedIN') == FALSE ) redirect('auth/logout');
	}

	public function index()
	{
		$data['title'] = $this->title;
		$data['subtitle'] = 'Dashboard';
		$data['jmlPengguna'] = $this->GeneralModel->count_by_id_general('at_pengguna','status_pengguna',1);
		$data['penggunaBaru'] = $this->GeneralModel->limit_general_order_by('v_pengguna','created_time','DESC',5);
		$data['pengguna'] = $this->GeneralModel->get_by_id_general('v_pengguna','id_pengguna',$this->session->userdata('id_pengguna'));
		if ($this->session->userdata('hak_akses')!='member') {
			$data['content'] = 'panel/dashboard/index';
		}else{
			$data['content'] = 'panel/dashboard/member';
			$data['newRequest'] = $this->PenggunaModel->friendRequest($this->session->userdata('id_pengguna'));
			$data['global'] = $this->GeneralModel->limit_by_id_general_order_by('at_pengguna','hak_akses','member','point','DESC',10);
			$data['getEaster'] = $this->GeneralModel->get_by_id_general('at_easter','pengguna',$this->session->userdata('id_pengguna'));
			$data['pengguna'] = $this->GeneralModel->get_general('at_pengguna');
		}
		$data['jmlCourse'] = $this->GeneralModel->count_by_id_general('at_course','status_course','Y');
		$this->load->view('panel/content', $data);
	}

	public function addEaster($param1=''){
		if ($param1=='updateNotif') {
			$data = array(
				'notif' => 'Y'
			);
			$this->GeneralModel->update_general('at_easter','pengguna',$this->session->userdata('id_pengguna'),$data);
		}else{
			$getPengguna = $this->GeneralModel->get_by_id_general('at_pengguna','id_pengguna',$this->session->userdata('id_pengguna'));
			$getEaster = $this->GeneralModel->get_by_id_general('at_easter','pengguna',$this->session->userdata('id_pengguna'));
			if ($getEaster) {
				foreach ($getEaster as $key) {
					if ($key->jumlah_klik+1 < 10) {
						$data = array(
							'jumlah_klik' => $key->jumlah_klik+1,
						);				
						$this->GeneralModel->update_general('at_easter','pengguna',$this->session->userdata('id_pengguna'),$data);
					}elseif($key->jumlah_klik+1 == 10){
						if ($key->status!='Y') {
							$dataPengguna = array(
								'exp' => $getPengguna[0]->exp+100,
								'pizza' => $getPengguna[0]->pizza+5
							);
							$this->GeneralModel->update_general('at_pengguna','id_pengguna',$this->session->userdata('id_pengguna'),$dataPengguna);
							$this->session->set_userdata($dataPengguna);
						}

						$data = array(
							'status' => 'Y',
							'jumlah_klik' => $key->jumlah_klik+1
						);
						$this->GeneralModel->update_general('at_easter','pengguna',$this->session->userdata('id_pengguna'),$data);
					}
				}
			}else{
				$data = array(
					'jumlah_klik' => 1,
					'pengguna' => $this->session->userdata('id_pengguna'),
				);
				$this->GeneralModel->create_general('at_easter',$data);
			}
		}
	}

}
