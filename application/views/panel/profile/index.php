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
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php foreach($pengguna as $key):?>
            <div class="profile-left">
                <!-- begin profile-image -->
                <div class="profile-image">
                    <?php if(!empty($key->foto_pengguna)): ?>
                      <img src="<?php echo base_url().$key->foto_pengguna;?>" />
                    <?php else: ?>
                      <img src="<?php echo base_url().$logo;?>" />
                    <?php endif; ?>
                    <i class="fa fa-user hide"></i>
                </div>
                <!-- end profile-image -->
                <div class="m-b-10">
                    <?php if(!empty($cekFriend)): ?>
                      <?php if($cekFriend->konfirmasi == 'N'): ?>
                        <a href="#" class="btn btn-warning btn-block btn-sm">Waiting Confirmation</a>
                      <?php else: ?>
                        <a href="#" class="btn btn-primary btn-block btn-sm">Already Friends</a>
                      <?php endif; ?>
                    <?php else: ?>
                      <a href="<?php echo base_url('panel/profile/addFriend/'.$key->id_pengguna);?>" class="btn btn-primary btn-block btn-sm">Add Friends</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="profile-right">
                <!-- begin profile-info -->
                <div class="profile-info">
                    <!-- begin table -->
                    <div class="table-responsive">
                        <table class="table table-profile">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="2">
                                        <h4><?php echo $key->nama_lengkap;?></h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="highlight">
                                    <td class="field">Username</td>
                                    <td><a href="#"><?php echo $key->username;?></a></td>
                                </tr>
                                <tr class="divider">
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="field">Whatsapp</td>
                                    <td><i class="fa fa-mobile fa-lg m-r-5"></i> <a href="#" class="m-l-5"><?php echo $key->no_hp;?></a></td>
                                </tr>
                                <tr>
                                    <td class="field">Email</td>
                                    <td><a href="#"><?php echo $key->email;?></a></td>
                                </tr>
                                <tr>
                                    <td class="field">Birth Date</td>
                                    <td><a href="#"><?php echo $key->tgl_lahir;?></a></td>
                                </tr>
                                <tr class="divider">
                                    <td colspan="2"></td>
                                </tr>
                                <tr class="highlight">
                                    <td class="field">Address</td>
                                    <td><a href="#"><?php echo $key->alamat;?></a></td>
                                </tr>
                                <tr class="divider">
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-3 text-center">
                          <img src="<?php echo base_url('assets/icon/exp.png');?>" style="width:50px;"><h2><?php echo number_format($key->exp,0,'.','.');?></h2>
                        </div>
                        <div class="col-md-3 text-center">
                          <img src="<?php echo base_url('assets/icon/point.png');?>" style="width:50px;"><h2><?php echo number_format($key->point,0,'.','.');?></h2>
                        </div>
                        <div class="col-md-3 text-center">
                          <img src="<?php echo base_url('assets/icon/pizza.png');?>" style="width:50px;"><h2><?php echo number_format($key->pizza,0,'.','.');?></h2>
                        </div>
                    </div>
                    <!-- end table -->
                </div>
                <!-- end profile-info -->
            </div>
            <?php endforeach;?>
        </div>
      </div>
    </div>
    <!-- end col-12 -->
  </div>
  <!-- end row -->
</div>
<!-- end #content -->