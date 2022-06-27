<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MasterCourse extends CI_Controller
{

	public $parent_modul = 'MasterCourse';
	public $title = 'Master Course';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
		if (cekParentModul($this->parent_modul) == FALSE) redirect('panel/dashboard');
		$this->akses_controller = $this->uri->segment(3);
	}

	public function daftarCourse($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			return $this->MasterCourseModel->getCourse();
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Course';
			$data['content'] = 'panel/masterCourse/course/index';
			$this->load->view('panel/content', $data);
		}
	}

	public function createCourse($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$data = array(
				'nama_course' => $this->input->post('nama_course'),
				'keterangan_course' => $this->input->post('keterangan_course'),
			);
			//---------------- UPDATE GAMBAR COURSE ---------------//
			$config['upload_path'] = 'assets/img/course/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 10000;


			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar_course')) {
			} else {
				$data += array('gambar_course' => $config['upload_path'] . $this->upload->data('file_name'));
			}
			if ($this->GeneralModel->create_general('at_course', $data) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data course berhasil ditambahkan</div>');
				redirect(changeLink('panel/masterCourse/daftarCourse'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data course gagal ditambahkan</div>');
				redirect(changeLink('panel/masterCourse/daftarCourse'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Course';
			$data['content'] = 'panel/masterCourse/course/create';
			$this->load->view('panel/content', $data);
		}
	}

	public function updateCourse($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$course = $this->GeneralModel->get_by_id_general('at_course','id_course',$param2);
			$data = array(
				'nama_course' => $this->input->post('nama_course'),
				'keterangan_course' => $this->input->post('keterangan_course'),
				'status_course' => $this->input->post('status_course'),
			);
			//---------------- UPDATE GAMBAR COURSE ---------------//
			$config['upload_path'] = 'assets/img/course/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 10000;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar_course')) {
			} else {
				if (!empty($course[0]->gambar_course)) {
					unlink($course[0]->gambar_course);
				}
				$data += array('gambar_course' => $config['upload_path'] . $this->upload->data('file_name'));
			}
			if ($this->GeneralModel->update_general('at_course','id_course',$param2,$data) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data course berhasil diupdate</div>');
				redirect(changeLink('panel/masterCourse/daftarCourse'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data course gagal diupdate</div>');
				redirect(changeLink('panel/masterCourse/daftarCourse'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Course';
			$data['content'] = 'panel/masterCourse/course/update';
			$data['course'] = $this->GeneralModel->get_by_id_general('at_course','id_course',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteCourse($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$course = $this->GeneralModel->get_by_id_general('at_course','id_course',$param1);
		if (!empty($course[0]->gambar_course)) {
			unlink($course[0]->gambar_course);
		}
		if ($this->GeneralModel->delete_general('at_course','id_course',$param1) == true) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data course berhasil dihapus</div>');
			redirect(changeLink('panel/masterCourse/daftarCourse'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data course gagal dihapus</div>');
			redirect(changeLink('panel/masterCourse/daftarCourse'));
		}
	}

	public function daftarMateri($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$course = $this->input->post('id_course');
			return $this->MasterCourseModel->getMateri($course);
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Materi';
			$data['content'] = 'panel/masterCourse/materi/index';
			$data['course'] = $this->GeneralModel->get_general('at_course');
			$data['id_course'] = $this->input->get('id_course');
			$this->load->view('panel/content', $data);
		}
	}

	public function createMateri($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$data = array(
				'course' => $this->input->post('course'),
				'urutan_materi' => $this->input->post('urutan_materi'),
				'nama_materi' => $this->input->post('nama_materi'),
			);

			if ($this->GeneralModel->create_general('at_materi', $data) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data materi berhasil ditambahkan</div>');
				redirect(changeLink('panel/masterCourse/daftarMateri'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data materi gagal ditambahkan</div>');
				redirect(changeLink('panel/masterCourse/daftarMateri'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Materi';
			$data['content'] = 'panel/masterCourse/materi/create';
			$data['course'] = $this->GeneralModel->get_general('at_course');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateMateri($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$data = array(
				'course' => $this->input->post('course'),
				'urutan_materi' => $this->input->post('urutan_materi'),
				'nama_materi' => $this->input->post('nama_materi'),
				'status_materi' => $this->input->post('status_materi'),
			);
			if ($this->GeneralModel->update_general('at_materi','id_materi',$param2,$data) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data materi berhasil diupdate</div>');
				redirect(changeLink('panel/masterCourse/daftarMateri'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data materi gagal diupdate</div>');
				redirect(changeLink('panel/masterCourse/daftarMateri'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Materi';
			$data['content'] = 'panel/masterCourse/materi/update';
			$data['course'] = $this->GeneralModel->get_general('at_course');
			$data['materi'] = $this->GeneralModel->get_by_id_general('at_materi','id_materi',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteMateri($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('at_materi','id_materi',$param1) == true) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data materi berhasil dihapus</div>');
			redirect(changeLink('panel/masterCourse/daftarMateri'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data materi gagal dihapus</div>');
			redirect(changeLink('panel/masterCourse/daftarMateri'));
		}
	}

	public function getMateri(){
		$course = $this->input->post('course');
		$getMateri = $this->GeneralModel->get_by_id_general('at_materi','course',$course);
		if ($getMateri) {
			echo json_encode($getMateri,JSON_PRETTY_PRINT);
		}else{
			echo 'false';
		}
	}

	public function daftarSoal($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$course = $this->input->post('id_course');
			$materi = $this->input->get('id_materi');
			return $this->MasterCourseModel->getSoal($course,$materi);
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Soal';
			$data['content'] = 'panel/masterCourse/soal/index';
			$data['course'] = $this->GeneralModel->get_general('at_course');
			$data['id_course'] = $this->input->get('id_course');
			$data['materi'] = $this->GeneralModel->get_by_id_general('at_materi','course',$data['id_course']);
			$data['id_materi'] = $this->input->get('id_materi');
			$this->load->view('panel/content', $data);
		}
	}

	public function createSoal($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$data = array(
				'course' => $this->input->post('course'),
				'materi' => $this->input->post('materi'),
				'urutan_soal' => $this->input->post('urutan_soal'),
				'isi_soal' => $this->input->post('isi_soal'),
				'tipe_soal' => $this->input->post('tipe_soal'),
				'jawaban_a' => $this->input->post('jawaban_a'),
				'jawaban_b' => $this->input->post('jawaban_b'),
				'jawaban_c' => $this->input->post('jawaban_c'),
				'jawaban_d' => $this->input->post('jawaban_d'),
				'kunci_jawaban' => $this->input->post('kunci_jawaban'),
				'jawaban_essay' => $this->input->post('jawaban_essay'),
				'jumlah_exp' => $this->input->post('jumlah_exp'),
				'exp_min' => $this->input->post('exp_min'),
				'jumlah_point' => $this->input->post('jumlah_point'),
				'point_min' => $this->input->post('point_min'),
				'time' => $this->input->post('time'),
			);

			if ($this->GeneralModel->create_general('at_soal', $data) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data soal berhasil ditambahkan</div>');
				redirect(changeLink('panel/masterCourse/daftarSoal'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data soal gagal ditambahkan</div>');
				redirect(changeLink('panel/masterCourse/daftarSoal'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Soal';
			$data['content'] = 'panel/masterCourse/soal/create';
			$data['course'] = $this->GeneralModel->get_general('at_course');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateSoal($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$data = array(
				'course' => $this->input->post('course'),
				'materi' => $this->input->post('materi'),
				'urutan_soal' => $this->input->post('urutan_soal'),
				'isi_soal' => $this->input->post('isi_soal'),
				'tipe_soal' => $this->input->post('tipe_soal'),
			);

			if ($data['tipe_soal'] == 'pilgan') {
				$data += array(
					'jawaban_a' => $this->input->post('jawaban_a'),
					'jawaban_b' => $this->input->post('jawaban_b'),
					'jawaban_c' => $this->input->post('jawaban_c'),
					'jawaban_d' => $this->input->post('jawaban_d'),
					'kunci_jawaban' => $this->input->post('kunci_jawaban'),
					'jumlah_exp' => $this->input->post('jumlah_exp'),
					'exp_min' => $this->input->post('exp_min'),
					'jumlah_point' => $this->input->post('jumlah_point'),
					'point_min' => $this->input->post('point_min'),
					'time' => $this->input->post('time'),
				);
			}elseif ($data['tipe_soal'] == 'essay') {
				$data += array(
					'jawaban_essay' => $this->input->post('jawaban_essay'),
					'jumlah_exp' => $this->input->post('jumlah_exp'),
					'exp_min' => $this->input->post('exp_min'),
					'jumlah_point' => $this->input->post('jumlah_point'),
					'point_min' => $this->input->post('point_min'),
					'time' => $this->input->post('time'),
				);
			}else{
				$data += array(
					'jawaban_a' => null,
					'jawaban_b' => null,
					'jawaban_c' => null,
					'jawaban_d' => null,
					'kunci_jawaban' => null,
					'jawaban_essay' => null,
					'jumlah_exp' => null,
					'exp_min' => null,
					'jumlah_point' => null,
					'point_min' => null,
					'time' => null,
				);
			}

			if ($this->GeneralModel->update_general('at_soal','id_soal',$param2,$data) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data soal berhasil diupdate</div>');
				redirect(changeLink('panel/masterCourse/daftarSoal'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data soal gagal diupdate</div>');
				redirect(changeLink('panel/masterCourse/daftarSoal'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Soal';
			$data['content'] = 'panel/masterCourse/soal/update';
			$data['course'] = $this->GeneralModel->get_general('at_course');
			$data['soal'] = $this->GeneralModel->get_by_id_general('v_soal','id_soal',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteSoal($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('at_soal','id_soal',$param1) == true) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data soal berhasil dihapus</div>');
			redirect(changeLink('panel/masterCourse/daftarSoal'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data soal gagal dihapus</div>');
			redirect(changeLink('panel/masterCourse/daftarSoal'));
		}
	}

	public function getDataSoal(){
		$id_soal = $this->input->post('id_soal');
		$getSoal = $this->GeneralModel->get_by_id_general('v_soal','id_soal',$id_soal);
		if ($getSoal) {
			echo json_encode($getSoal,JSON_PRETTY_PRINT);
		}else{
			echo 'false';
		}
	}

	public function getDataPizza(){
		$id_soal = $this->input->post('id_soal');
		$getPizza = $this->GeneralModel->get_by_id_general_order_by('at_earn_pizza','soal',$id_soal,'jumlah_pizza',"DESC");
		if ($getPizza) {
			echo json_encode($getPizza,JSON_PRETTY_PRINT);
		}else{
			echo 'false';
		}
	}

	public function tambahPizza($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$data = array(
				'jumlah_pizza' => $this->input->post('jumlah_pizza'),
				'max_time' => $this->input->post('max_time'),
				'soal' => $this->input->post('soal'),
			);

			if ($this->GeneralModel->create_general('at_earn_pizza', $data) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data pizza berhasil ditambahkan</div>');
				redirect(changeLink('panel/masterCourse/daftarSoal#'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data pizza gagal ditambahkan</div>');
				redirect(changeLink('panel/masterCourse/daftarSoal#'));
			}
		}
	}

	public function deletePizza($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('at_earn_pizza','id_earn_pizza',$param1) == true) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data pizza berhasil dihapus</div>');
			redirect(changeLink('panel/masterCourse/daftarSoal#'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data pizza gagal dihapus</div>');
			redirect(changeLink('panel/masterCourse/daftarSoal#'));
		}
	}

}
