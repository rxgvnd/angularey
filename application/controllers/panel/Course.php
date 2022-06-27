<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public $parent_modul = 'Course';
	public $title = 'Course';

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('LoggedIN') == FALSE ) redirect('auth/logout');
	}

	public function index()
	{
		$data['title'] = $this->title;
		$data['subtitle'] = 'Course';
		$data['course'] = $this->GeneralModel->get_by_id_general_order_by('v_course','status_course','Y','id_course','ASC');
		$data['content'] = 'panel/course/index';
		$this->load->view('panel/content', $data);
	}

	public function learn($param1='')
	{
		$course = $this->GeneralModel->get_by_id_general('v_course','id_course',$param1);
		if(cekLevel($param1) == TRUE){
			$data = array(
				'pengguna' => $this->session->userdata('id_pengguna'),
				'course' => $param1,
				'finish_course' => 'N'
			);
			$cekCourse = $this->GeneralModel->get_by_multi_id_general('at_course_pengguna','course',$param1,'pengguna',$this->session->userdata('id_pengguna'));
			if ($cekCourse) {
				redirect('panel/course/lessons/'.$param1);				
			}else{
				$this->GeneralModel->create_general('at_course_pengguna',$data);
				redirect('panel/course/lessons/'.$param1);				
			}
		}else{
			$this->session->set_flashdata('notif','<div class="alert alert-danger">Oopps.., Sorry you mush finishing previous level to learn '.$course[0]->nama_course.'</div>');
			redirect('panel/course/');
		}
	}

	public function lessons($param1=''){
		if(cekLevel($param1) == FALSE ) redirect('panel/course/learn/'.$param1);
		$data['title'] = $this->title;
		$data['subtitle'] = 'Lessons';
		$data['lessons'] = $this->GeneralModel->get_by_multi_id_general_order_by('v_materi','status_materi','Y','course',$param1,'urutan_materi','ASC');
		$data['course'] = $this->GeneralModel->get_by_id_general('v_course','id_course',$param1);
		$data['content'] = 'panel/course/lessons';
		$this->load->view('panel/content', $data);
	}

	public function training($param1='',$param2='',$param3=''){
		if(cekSoal($param1,$param2,$param3) == FALSE) redirect('panel/course/learn/'.$param2);
		$getMateri = $this->GeneralModel->get_by_multi_id_general('v_materi','id_materi',$param2,'course',$param3);
			if ($getMateri) {
			$cekSoalPengguna = $this->GeneralModel->get_by_fourth_id_general('at_soal_pengguna','pengguna',$this->session->userdata('id_pengguna'),'urutan_soal',$param1,'materi',$param2,'course',$param3);
			$data['soal'] = $this->GeneralModel->get_by_multi_id_general('at_soal','urutan_soal',$param1,'materi',$getMateri[0]->id_materi);
			if (empty($cekSoalPengguna)) {
				$dataSoal = array(
					'course' => $param3,
					'materi' => $param2,
					'urutan_soal' => $param1,
					'pengguna' => $this->session->userdata('id_pengguna'),
				);
				if ($data['soal'][0]->tipe_soal=='narasi') {
					$dataSoal +=  array('finish_soal' => 'Y');
				}
				$this->GeneralModel->create_general('at_soal_pengguna',$dataSoal);
			}
			$data['title'] = $this->title;
			$data['subtitle'] = 'Training';
			$data['course'] = $getMateri;
			$data['nextSoal'] = $param1+1;
			$data['cekTimer'] = $this->GeneralModel->get_by_fourth_id_general('at_soal_pengguna','pengguna',$this->session->userdata('id_pengguna'),'urutan_soal',$param1,'materi',$param2,'course',$param3);
			$data['content'] = 'panel/course/training';
			$this->load->view('panel/content', $data);
		}else{
			$this->session->set_flashdata('notif','<div class="alert alert-danger">Oopps.., Sorry data not found!</div>');
			redirect('panel/course/');
		}
	}

	public function updateWaktu(){
		$course = $this->input->post('course');
		$materi = $this->input->post('materi');
		$urutan_soal = $this->input->post('urutan_soal');
		$used_time = $this->input->post('timer');
		$data = array(
			'used_time' => $used_time,
			'learning_time' => DATE('Y-m-d H:i:s')
		);
		$this->GeneralModel->update_fourth_id_general('at_soal_pengguna','pengguna',$this->session->userdata('id_pengguna'),'urutan_soal',$urutan_soal,'materi',$materi,'course',$course,$data);
	}

	public function simpanJawaban(){
		$course = $this->input->post('course');
		$materi = $this->input->post('materi');
		$urutan_soal = $this->input->post('urutan_soal');
		$tipe_soal = $this->input->post('tipe_soal');
		$used_time = $this->input->post('used_time');
		$jawaban = $this->input->post('jawaban');
		$cekJawaban = $this->GeneralModel->get_by_triple_id_general('at_soal','materi',$materi,'course',$course,'urutan_soal',$urutan_soal);
		$cekSoalPengguna = $this->GeneralModel->get_by_fourth_id_general('at_soal_pengguna','pengguna',$this->session->userdata('id_pengguna'),'urutan_soal',$urutan_soal,'materi',$materi,'course',$course);
		if($cekSoalPengguna[0]->finish_soal == 'N'){
			if ($cekJawaban) {
				foreach ($cekJawaban as $key) {

					$getPizza = $this->MasterCourseModel->getPizza($key->id_soal,$used_time);
					if ($getPizza) {
						$jumlah_pizza = $getPizza->jumlah_pizza;
					}else{
						$jumlah_pizza = 0;
					}

					if ($tipe_soal=='pilgan') {
						if($key->kunci_jawaban == $jawaban){
							$data = array(
								'jawaban_soal' => $jawaban,
								'finish_soal' => 'Y',
								'finish_time' => DATE('Y-m-d H:i:s')
							);

							if ($used_time>0) {
								$data += array(
									'earned_exp' => $key->jumlah_exp,
									'earned_point' => $key->jumlah_point,
								);
							}else{
								$data += array(
									'earned_exp' => $key->exp_min,
									'earned_point' => $key->point_min,
								);
							}

							$data += array(
								'earned_pizza' => $jumlah_pizza
							);

							$this->GeneralModel->update_fourth_id_general('at_soal_pengguna','pengguna',$this->session->userdata('id_pengguna'),'urutan_soal',$urutan_soal,'materi',$materi,'course',$course,$data);
							echo json_encode($data,JSON_PRETTY_PRINT);
							$dataPengguna = array(
								'exp' => $this->session->userdata('exp') + $data['earned_exp'],
								'point' => $this->session->userdata('point') + $data['earned_point'],
								'pizza' => $this->session->userdata('pizza') + $data['earned_pizza'],
							);
							$this->GeneralModel->update_general('at_pengguna','id_pengguna',$this->session->userdata('id_pengguna'),$dataPengguna);
							$this->session->set_userdata($dataPengguna);
						}else{
							echo 'false';
						}
					}else{
						$jmlJawab = count($jawaban);
						$jml = 0;
						$jawabanEssay = json_decode($key->jawaban_essay);
						for ($i=0; $i < $jmlJawab; $i++) { 
							if($jawaban[$i] == $jawabanEssay[$i]){
								$jml++;
							}
						}
						if($jml == $jmlJawab){
							$data = array(
								'jawaban_soal' => json_encode($jawaban),
								'finish_soal' => 'Y',
								'finish_time' => DATE('Y-m-d H:i:s')
							);

							if ($used_time>0) {
								$data += array(
									'earned_exp' => $key->jumlah_exp,
									'earned_point' => $key->jumlah_point,
								);
							}else{
								$data += array(
									'earned_exp' => $key->exp_min,
									'earned_point' => $key->point_min,
								);
							}

							$data += array(
								'earned_pizza' => $jumlah_pizza
							);

							$this->GeneralModel->update_fourth_id_general('at_soal_pengguna','pengguna',$this->session->userdata('id_pengguna'),'urutan_soal',$urutan_soal,'materi',$materi,'course',$course,$data);
							$dataPengguna = array(
								'exp' => $this->session->userdata('exp') + $data['earned_exp'],
								'point' => $this->session->userdata('point') + $data['earned_point'],
								'pizza' => $this->session->userdata('pizza') + $data['earned_pizza'],
							);
							$this->GeneralModel->update_general('at_pengguna','id_pengguna',$this->session->userdata('id_pengguna'),$dataPengguna);
							$this->session->set_userdata($dataPengguna);
							echo json_encode($data,JSON_PRETTY_PRINT);
						}else{
							echo 'false';
						}
					}
				}
			}else{
				echo 'false';
			}
		}else{
				echo 'denied';
		}
	}

	public function getHint(){
		$course = $this->input->post('course');
		$materi = $this->input->post('materi');
		$urutan_soal = $this->input->post('urutan_soal');
		$getPengguna = $this->GeneralModel->get_by_id_general('at_pengguna','id_pengguna',$this->session->userdata('id_pengguna'));
		foreach ($getPengguna as $key) {
			if ($key->hint>0) {
				$dataHint = array(
					'hint' => $key->hint-1
				);
				$this->GeneralModel->update_general('at_pengguna','id_pengguna',$key->id_pengguna,$dataHint);
				$this->session->set_userdata($dataHint);
				$cekJawaban = $this->GeneralModel->get_by_triple_id_general('at_soal','materi',$materi,'course',$course,'urutan_soal',$urutan_soal);
				if ($cekJawaban) {
					$data = array(
						'soal' => $cekJawaban[0]->id_soal,
						'pengguna' => $this->session->userdata('id_pengguna')
					);
					$this->GeneralModel->create_general('at_hint',$data);
					echo 'true';
				}else{
					echo "false";
				}
			}else{
				echo 'false';
			}
		}
	}

}
