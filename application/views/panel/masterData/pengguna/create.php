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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/masterData/createPengguna/doCreate/')); ?>"  enctype="multipart/form-data">
            <div class="col-md-12">
              <h4 class="text-center">Foto Pengguna</h4>
              <center>
                <img src="<?php echo base_url('assets/img/user.png'); ?>" class="img-responsive" alt="preview" id="preview" style="height:150px">
              </center>
              <br />
              <div class="form-group">
                <label class="col-md-2 control-label">Foto Pengguna</label>
                <div class="col-md-10">
                  <input type="file" name="foto_pengguna" class="form-control" id="foto_pengguna" accept="image/*" />
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
              $("#foto_pengguna").change(function() {
                readURL(this);
              });
            </script>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Lengkap</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap Pengguna" name="nama_lengkap" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Jenkel</label>
                <div class="col-md-10">
                  <select name="jenkel" id="jenkel" class="form-control">
                    <option value="">.:Pilih Jenkel:.</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Tgl Lahir</label>
                <div class="col-md-10">
                  <input type="date" class="form-control" placeholder="Masukkan tgl lahir" name="tgl_lahir" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Alamat</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Alamat" name="alamat" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-2 control-label">Username</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan username pengguna" name="username" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-10">
                  <input type="email" class="form-control" placeholder="Masukkan email" name="email" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">No HP</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" onkeypress="onlyNumberKey(event)" placeholder="Masukkan No HP" name="no_hp" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Password</label>
                <div class="col-md-10">
                  <input type="password" class="form-control" placeholder="Masukkan Password" name="password" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Hak Akses</label>
                <div class="col-md-10">
                  <select class="form-control" id="hak_akses" name="hak_akses" required>
                    <option value="">.:Pilih Hak Akses:.</option>
                    <?php foreach ($hakAkses as $key) : ?>
                      <option value="<?php echo $key->nama_hak_akses; ?>"><?php echo $key->nama_hak_akses; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <hr />
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm pac-dream text-white  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/masterData/pengguna/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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
<script type="text/javascript">
  $('#data-table').DataTable();
</script>