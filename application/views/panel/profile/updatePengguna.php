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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/profile/edit/doEdit/')); ?>" enctype="multipart/form-data">
            <div class="col-md-12">
              <center>
                <?php if (!empty($pengguna[0]->foto_pengguna)) : ?>
                  <img src="<?php echo base_url() . $pengguna[0]->foto_pengguna; ?>" class="img-responsive" alt="preview" id="preview" style="height:150px">
                <?php else : ?>
                  <img src="<?php echo base_url('assets/img/user.png'); ?>" class="img-responsive" alt="preview" id="preview" style="height:120px">
                <?php endif; ?>
              </center>
              <br />
              <div class="form-group">
                <label class="col-md-2 control-label">Avatar User</label>
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
                <label class="col-md-2 control-label">Username</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Your Username" value="<?php echo $pengguna[0]->username; ?>" name="username" disabled />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Full Name</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Your Full Name" value="<?php echo $pengguna[0]->nama_lengkap; ?>" name="nama_lengkap" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Gender</label>
                <div class="col-md-10">
                  <select name="jenkel" id="jenkel" class="form-control">
                    <option value="">.:Choose:.</option>
                    <option value="L">Male</option>
                    <option value="P">Female</option>
                  </select>
                </div>
                <script>
                  $('#jenkel').val('<?php echo $pengguna[0]->jenkel; ?>')
                </script>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Date of Birth</label>
                <div class="col-md-10">
                  <input type="date" class="form-control" placeholder="Your Birthdate" name="tgl_lahir" value="<?php echo $pengguna[0]->tgl_lahir; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Address</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Your Address" value="<?php echo $pengguna[0]->alamat; ?>" name="alamat" required />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-10">
                  <input type="email" class="form-control" placeholder="Your Email" value="<?php echo $pengguna[0]->email; ?>" name="email" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Phone Number</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Your Phone Number" onkeypress="onlyNumberKey(event)" value="<?php echo $pengguna[0]->no_hp; ?>" name="no_hp" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">New Password</label>
                <div class="col-md-10">
                  <input type="password" class="form-control" placeholder="Your New Password" id="password" onkeyup="cekPassword()" name="password" />
                  <!-- <font color="red" id="notifpass"></font> -->
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Re-type New Password</label>
                <div class="col-md-10">
                  <input type="password" class="form-control" placeholder="Re-type New Password" onkeyup="cekPassword()" id="re_password" name="re_password" />
                  <font color="red" id="notifrepass"></font>
                </div>
              </div>
              <script type="text/javascript">
                function cekPassword() {
                  var repass = $('#re_password').val()
                  var pass = $('#password').val()
                  if (repass != pass || pass != repass) {
                    $('#notifrepass').prop('color', 'red');
                    $('#notifrepass').text('Ulangi password tidak sama dengan password');
                    $('#btnSimpan').attr('disabled', true);
                  } else {
                    $('#notifrepass').prop('color', 'green');
                    $('#notifrepass').text('Ulangi password sama dengan password');
                    $('#btnSimpan').removeAttr('disabled');
                  }
                }
              </script>
            </div>
            <div class="col-md-12">
              <hr />
              <div class="form-group">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-sm pac-dream text-white pull-right" id="btnSimpan" style="margin-left:10px">Save</button>
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