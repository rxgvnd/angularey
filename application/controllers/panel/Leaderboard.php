<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Leaderboard extends CI_Controller
{

	public $parent_modul = 'Leaderboard';
	public $title = 'Leaderboard';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
	}

	public function index(){
		$this->daftarLeaderboard();
	}

	public function daftarLeaderboard($param1=''){
			$data['title'] = $this->title;
			if ($param1!='friends') {
				$data['subtitle'] = 'Top 10 Global Leaderboard';
			}else{
				$data['subtitle'] = 'Top 10 Friends Leaderboard';
			}
			$data['content'] = 'panel/leaderboard/index';
			$data['tipe'] = $param1;
			$data['global'] = $this->GeneralModel->limit_by_id_general_order_by('at_pengguna','hak_akses','member','point','DESC',10);
			$this->load->view('panel/content', $data);
	}
}
