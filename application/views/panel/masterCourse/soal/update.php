<?php foreach($soal as $row):?>
<!-- begin #content -->
<?php if($this->session->userdata('hak_akses') != 'member'){?>
	<div id="content" class="content">
<?php }else{ ?>
	<div id="content" class="content" style="margin-left: 0px;">
<?php } ?>
  <!-- begin breadcrumb -->
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li><a href="javascript:;"><?php echo $title; ?></a></li>
    <li class="active"><?php echo $subtitle; ?></li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header"><?php echo $title; ?></h1>
  <!-- end page-header -->

  <!-- begin row -->
  <div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
      <!-- begin panel -->
      <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle pac-dream text-white" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/masterCourse/updateSoal/doUpdate/'.$row->id_soal)); ?>"  enctype="multipart/form-data">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Pilih Course</label>
                <div class="col-md-10">
                  <select name="course" id="course" class="form-control select2" style="width:100%;" onchange="cariMateri(this.value)" required>
                    <option value="">.:Pilih Course:.</option>
                    <?php foreach($course as $key):?>
                      <option value="<?php echo $key->id_course;?>"><?php echo $key->nama_course;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <script>
                $(document).ready(function(){
                  cariMateri("<?php echo $row->course;?>")
                  tipeSoal("<?php echo $row->tipe_soal;?>")
                })
              </script>
              <script>
                $('#course').val('<?php echo $row->course;?>')
                $('#kunci_jawaban').val('<?php echo $row->kunci_jawaban;?>')
                function cariMateri(val){
                  $('#materi').html('<option value="">.:Pilih Materi:.</option>');
                  $.ajax({
                    "url":"<?php echo base_url('panel/masterCourse/getMateri');?>",
                    "type":"POST",
                    "data":{
                      "course":val
                    },success:function(resp){
                      if (resp!='false') {
                        var data = JSON.parse(resp);
                        $.each(data,function(key,val){
                          $('#materi').append('<option value="'+val.id_materi+'">'+val.nama_materi+'</option>')
                        })
                        $('#materi').val("<?php echo $row->materi;?>")
                      }
                    }
                  })
                }
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Pilih Materi</label>
                <div class="col-md-10">
                  <select name="materi" id="materi" class="form-control select2" style="width:100%;" required>
                    <option value="">.:Pilih Materi:.</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Urutan Soal</label>
                <div class="col-md-10">
                  <input type="number" class="form-control" value="<?php echo $row->urutan_soal;?>" placeholder="Masukkan urutan soal" name="urutan_soal" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Isi Soal</label>
                <div class="col-md-10">
                  <textarea name="isi_soal" id="isi_soal" cols="30" rows="10" class="form-control" required><?php echo $row->isi_soal;?></textarea>
                  <script>
                    CKEDITOR.replace('isi_soal');
                  </script>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Tipe Soal</label>
                <div class="col-md-10">
                  <select name="tipe_soal" id="tipe_soal" class="form-control" onchange="tipeSoal(this.value)" required>
                    <option value="">.:Pilih Tipe Soal:.</option>
                    <option value="pilgan">Pilgan</option>
                    <option value="essay">Essay</option>
                    <option value="narasi">Narasi</option>
                  </select>
                  <font color="red">*Pilih tipe soal terlebih dahulu essay/pilgan/narasi</font>
                </div>
              </div>
              <script>
                $('#tipe_soal').val('<?php echo $row->tipe_soal;?>')
                function tipeSoal(val){
                  if(val == "essay"){
                    $('#formEssay').removeAttr('hidden');
                    $('#formPilgan').attr('hidden',true);
                    $('#formPoint').removeAttr('hidden');
                  }else if(val == "pilgan"){
                    $('#formEssay').attr('hidden',true);
                    $('#formPilgan').removeAttr('hidden');
                    $('#formPoint').removeAttr('hidden');
                  }else{
                    $('#formPoint').attr('hidden',true);
                    $('#formPilgan').attr('hidden',true);
                    $('#formEssay').attr('hidden',true);
                  }
                }
              </script>
              <div id="formPilgan" hidden>
                <div class="form-group">
                  <label class="col-md-2 control-label">Jawaban A</label>
                  <div class="col-md-10">
                    <textarea name="jawaban_a" id="jawaban_a" cols="30" rows="10" class="form-control"><?php echo $row->jawaban_a;?></textarea>
                    <script>
                      CKEDITOR.replace('jawaban_a');
                    </script>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Jawaban B</label>
                  <div class="col-md-10">
                    <textarea name="jawaban_b" id="jawaban_b" cols="30" rows="10" class="form-control"><?php echo $row->jawaban_b;?></textarea>
                    <script>
                      CKEDITOR.replace('jawaban_b');
                    </script>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Jawaban C</label>
                  <div class="col-md-10">
                    <textarea name="jawaban_c" id="jawaban_c" cols="30" rows="10" class="form-control"><?php echo $row->jawaban_c;?></textarea>
                    <script>
                      CKEDITOR.replace('jawaban_c');
                    </script>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Jawaban D</label>
                  <div class="col-md-10">
                    <textarea name="jawaban_d" id="jawaban_d" cols="30" rows="10" class="form-control"><?php echo $row->jawaban_d;?></textarea>
                    <script>
                      CKEDITOR.replace('jawaban_d');
                    </script>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Kunci Jawaban</label>
                  <div class="col-md-10">
                    <select name="kunci_jawaban" id="kunci_jawaban" class="form-control">
                      <option value="">.:Pilih Kunci Jawaban:.</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                    </select>
                  </div>
                </div>
              </div>
              <div id="formEssay" hidden>
                <div class="form-group">
                  <label class="col-md-2 control-label">Jawaban Essay</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" value="<?php echo $row->jawaban_essay;?>" id="jawaban_essay" placeholder="Masukkan jawaban essay" name="jawaban_essay">
                  </div>
                </div>
              </div>
              <div id="formPoint" hidden>
                <div class="form-group">
                  <label class="col-md-2 control-label">Exp Max</label>
                  <div class="col-md-10">
                    <input type="number" class="form-control" value="<?php echo $row->jumlah_exp;?>" id="jumlah_exp" placeholder="Masukkan Exp Max" name="jumlah_exp">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Exp Min</label>
                  <div class="col-md-10">
                    <input type="number" class="form-control" id="exp_min" value="<?php echo $row->exp_min;?>" placeholder="Masukkan Exp Min" name="exp_min">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Point Max</label>
                  <div class="col-md-10">
                    <input type="number" class="form-control" id="jumlah_point" value="<?php echo $row->jumlah_point;?>" placeholder="Masukkan Point Max" name="jumlah_point">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Point Min</label>
                  <div class="col-md-10">
                    <input type="number" class="form-control" id="point_min" value="<?php echo $row->point_min;?>" placeholder="Masukkan Point Min" name="point_min">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Waktu Pengerjaan (Second)</label>
                  <div class="col-md-10">
                    <input type="number" class="form-control" id="time" value="<?php echo $row->time;?>" placeholder="Masukkan Waktu Pengerjaan (Second)" name="time">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm pac-dream text-white  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/masterCourse/daftarSoal/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end col-12 -->
</div>
<!-- end row -->
</div>
<!-- end #content -->
<?php endforeach;?>
