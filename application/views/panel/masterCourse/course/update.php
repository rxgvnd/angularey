<?php foreach($course as $key):?>
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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/masterCourse/updateCourse/doUpdate/'.$key->id_course)); ?>"  enctype="multipart/form-data">
            <div class="col-md-12">
              <h4 class="text-center">Gambar Course</h4>
              <center>
                <?php if(!empty($key->gambar_course)): ?>
                  <img src="<?php echo base_url().$key->gambar_course; ?>" class="img-responsive" alt="preview" id="preview" style="height:150px">
                <?php else: ?>
                  <img src="<?php echo base_url().$icon; ?>" class="img-responsive" alt="preview" id="preview" style="height:150px">
                <?php endif; ?>
              </center>
              <br />
              <div class="form-group">
                <label class="col-md-2 control-label">Upload Gambar Course</label>
                <div class="col-md-10">
                  <input type="file" name="gambar_course" class="form-control" id="gambar_course" accept="image/*" />
                </div>
              </div>
            </div>
            <script type="text/javascript">
              function readURL(input) {
                if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                  }
                  reader.readAsDataURL(input.files[0]);
                }
              }
              $("#gambar_course").change(function() {
                readURL(this);
              });
            </script>
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Course</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Nama Course" value="<?php echo $key->nama_course;?>" name="nama_course" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Keterangan Course</label>
                <div class="col-md-10">
                  <textarea name="keterangan_course" id="keterangan_course" class="form-control" cols="30" rows="10"><?php echo $key->keterangan_course;?></textarea>
                </div>
                <script>
                    CKEDITOR.replace('keterangan_course');
                </script>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Status Course</label>
                <div class="col-md-10">
                  <select name="status_course" id="status_course" class="form-control">
                    <option value="">.:Pilih Status Course:.</option>
                    <option value="Y">Aktif</option>
                    <option value="N">Tidak Aktif</option>
                  </select>
                </div>
                <script>
                  $('#status_course').val('<?php echo $key->status_course;?>')
                </script>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm pac-dream text-white  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/masterCourse/daftarMateri/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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