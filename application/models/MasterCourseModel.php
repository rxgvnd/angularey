<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterCourseModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

    public function getCourse()
  {
    $this->datatables->select('*,at_course.id_course as id_course');
    $this->datatables->from('at_course');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterCourse/daftarMateri?id_course=$1'), '<i class="fa fa-search"></i>', array('class' => 'btn btn-info btn-xs')) . ' '
      . anchor(changeLink('panel/masterCourse/updateCourse/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterCourse/deleteCourse/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus course?')")),
      'id_course'
    );
    return print_r($this->datatables->generate('json'));
  }

    public function getMateri($course='')
  {
    $this->datatables->select('*,v_materi.id_materi as id_materi');
    $this->datatables->from('v_materi');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterCourse/updateMateri/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterCourse/deleteMateri/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus materi?')")),
      'id_materi'
    );
    if (!empty($course)) {
      $this->datatables->where("course",$course);
    }
    return print_r($this->datatables->generate('json'));
  }

    public function getSoal($course='',$materi='')
  {
    $this->datatables->select('*,v_soal.id_soal as id_soal');
    $this->datatables->from('v_soal');
    $this->datatables->add_column(
      'action',
        anchor(changeLink('panel/masterCourse/daftarSoal#'), '<i class="fa fa-money"></i> Point', array('class' => 'btn btn-primary btn-xs', 'onclick' => "earnPizza('$1')")) . ' '
        .anchor(changeLink('panel/masterCourse/updateSoal/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
        .anchor(changeLink('panel/masterCourse/deleteSoal/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus soal?')")),
      'id_soal'
    );
    if (!empty($course)) {
      $this->datatables->where("course",$course);
    }
    if (!empty($materi)) {
      $this->datatables->where("materi",$materi);
    }
    return print_r($this->datatables->generate('json'));
  }

  function getPizza($id_soal,$used_time){
    return $this->db->query("SELECT * FROM at_earn_pizza WHERE soal='$id_soal' and '$used_time' >= max_time")->row();
  }
}
