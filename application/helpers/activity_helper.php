<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function cekLevel($param1=''){
    $CI = &get_instance();
    if (!empty($param1)) {
			if($param1 > 1){
        cekFinishingLesson($param1-1);
        $cekFinishCourse = $CI->GeneralModel->get_by_triple_id_general('at_course_pengguna','course',$param1-1,'pengguna',$CI->session->userdata('id_pengguna'),'finish_course','Y');
        if($cekFinishCourse){
          return TRUE;
        }else{
          return FALSE;
        }      
			}else{
          return TRUE;
			}
		}
}

function cekSoal($param1='',$param2='',$param3=''){
    $CI = &get_instance();
    $lastMateri = $CI->db->query("SELECT max(id_materi) as id_materi FROM at_materi WHERE course = '$param3' AND id_materi < '$param2'")->row();
    if (!empty($param1)) {
			if($param1 > 1){
        $cekFinishSoal = $CI->GeneralModel->get_by_fifth_id_general('at_soal_pengguna','urutan_soal',$param1-1,'materi',$param2,'course',$param3,'pengguna',$CI->session->userdata('id_pengguna'),'finish_soal','Y');
        if($cekFinishSoal){
          return TRUE;
        }else{
          if ($lastMateri) {
            $cekLastMateri = $CI->GeneralModel->get_by_fifth_id_general('at_soal_pengguna','urutan_soal',$param1-1,'materi',$lastMateri->id_materi,'course',$param3,'pengguna',$CI->session->userdata('id_pengguna'),'finish_soal','Y');
            if($cekLastMateri){
              return TRUE;
            }else{
              return FALSE;
            }
          }else{
            return TRUE;
          }
        }      
			}else{
          return TRUE;
			}
		}
}

function cekNextSoal($course,$materi,$urutan_soal){
  $CI = &get_instance();
  $cekNextSoal = $CI->GeneralModel->get_by_triple_id_general('at_soal','urutan_soal',$urutan_soal,'materi',$materi,'course',$course);
  if ($cekNextSoal) {
    return TRUE;
  }
}

function cekPrevSoal($course,$materi,$urutan_soal){
  $CI = &get_instance();
  $cekPrevSoal = $CI->GeneralModel->get_by_triple_id_general('at_soal','urutan_soal',$urutan_soal-1,'materi',$materi,'course',$course);
  if ($cekPrevSoal) {
    return TRUE;
  }else{
    return FALSE;
  }
}

function cekFinishingLesson($course){
  $CI = &get_instance();
  $pengguna = $CI->session->userdata('id_pengguna');
  $cekLastSoalId = $CI->db->query("SELECT id_soal, urutan_soal FROM at_soal WHERE course = '$course' ORDER BY id_soal DESC LIMIT 1")->row();
  $cekLastSoalFinished = $CI->db->query("SELECT * FROM at_soal_pengguna WHERE course = '$course' AND pengguna = '$pengguna' AND urutan_soal = '$cekLastSoalId->urutan_soal'")->row();
  if(!empty($cekLastSoalFinished)){
    if ($cekLastSoalFinished->finish_soal == 'Y') {
      $data = array(
        'finish_course' => 'Y'
      );
      $CI->GeneralModel->update_multi_id_general('at_course_pengguna','course',$course,'pengguna',$CI->session->userdata('id_pengguna'),$data);
    }
  }
}