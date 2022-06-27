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
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <?php if($tipe!='friends'): ?>
              <a href="<?php echo base_url('panel/leaderboard/');?>" class="btn btn-warning btn-xs">Global</a>
              <a href="<?php echo base_url('panel/leaderboard/daftarLeaderboard/friends');?>" class="btn btn-default btn-xs">Friends</a>
            <?php else: ?>
              <a href="<?php echo base_url('panel/leaderboard/');?>" class="btn btn-default btn-xs">Global</a>
              <a href="<?php echo base_url('panel/leaderboard/daftarLeaderboard/friends');?>" class="btn btn-warning btn-xs">Friends</a>
            <?php endif; ?>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <br />
          <?php if($tipe!='friends'): ?>
            <table id="table" class="table table-striped table-bordered" width="100%">
              <thead>
                <tr>
                  <th style="text-align:center">RANK</th>
                  <th>USERNAME</th>
                  <th>POINTS</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach($global as $key):?>
                <?php $style="style='font-size:25px;'";?>
                <?php if($key->id_pengguna == $this->session->userdata('id_pengguna')): ?>
                  <?php $background="background-color:#6BC5D2";$text="color:white";$color="white";?>
                <?php else: ?>
                  <?php $background="";$text="";$color="inverse"?>
                <?php endif; ?>
                <tr style="<?php echo $text;?>">
                  <?php if($no==1): ?>
                  <td  style="<?php echo $background;?>" width="30px;">
                      <img src="<?php echo base_url('assets/icon/rank1.png');?>" class="rounded" style="height:60px;">
                  </td>
                  <?php elseif($no==2): ?>
                  <td  style="<?php echo $background;?>" width="30px;">
                      <img src="<?php echo base_url('assets/icon/rank2.png');?>" class="rounded" style="height:60px;">
                  </td>
                  <?php elseif($no==3): ?>
                  <td style="<?php echo $background;?>" width="30px;">
                      <img src="<?php echo base_url('assets/icon/rank3.png');?>" class="rounded" style="height:60px;">
                  </td>
                  <?php else: ?>
                  <td style="<?php echo $background;?>" align="center"><span <?php echo $style;?>><?php echo $no;?></span></td>
                  <?php endif; ?>
                  <td style="<?php echo $background;?>">
                    <?php if(!empty($key->foto_pengguna)): ?>
                      <img src="<?php echo base_url().$key->foto_pengguna;?>" class="rounded" style="height:50px;">
                    <?php else: ?>
                      <img src="<?php echo base_url('assets/img/user.png')?>" class="rounded" style="height:50px;">
                    <?php endif; ?>
                      <span <?php echo $style;?>> <a class="text-<?php echo $color;?>" href="<?php echo base_url('panel/profile/user/'.$key->id_pengguna);?>"><?php echo $key->username;?></a></span>
                  </td>
                  <td style="<?php echo $background;?>"><span <?php echo $style;?>><?php echo $key->point;?></span></td>
                </tr>
                <?php $no++; endforeach;?>
              </tbody>
            </table>
          <?php else: ?>
            <table id="table3" class="table table-striped table-bordered" width="100%">
              <thead>
              <tr>
                <th style="text-align:center">RANK</th>
                <th>USERNAME</th>
                <th>POINTS</th>
              </tr>
              </thead>
              <tbody>
              <?php $no=1; foreach($global as $key):?>
              <?php $style="style='font-size:25px;'";?>
              <?php if($key->id_pengguna == $this->session->userdata('id_pengguna')): ?>
                <?php $background="background-color:#6BC5D2";$text="color:white";$color="white";?>
              <?php else: ?>
                <?php $background="";$text="";$color="inverse"?>
              <?php endif; ?>
              <?php $cekFriends = $this->PenggunaModel->cekFriends($this->session->userdata('id_pengguna'),$key->id_pengguna);?>
              <?php if(!empty($cekFriends) || $key->id_pengguna == $this->session->userdata('id_pengguna')): ?>
              <tr style="<?php echo $text;?>">
                <?php if($no==1): ?>
                <td  style="<?php echo $background;?>" width="30px;">
                  <img src="<?php echo base_url('assets/icon/rank1.png');?>" class="rounded" style="height:60px;">
                </td>
                <?php elseif($no==2): ?>
                <td  style="<?php echo $background;?>" width="30px;">
                  <img src="<?php echo base_url('assets/icon/rank2.png');?>" class="rounded" style="height:60px;">
                </td>
                <?php elseif($no==3): ?>
                <td style="<?php echo $background;?>" width="30px;">
                  <img src="<?php echo base_url('assets/icon/rank3.png');?>" class="rounded" style="height:60px;">
                </td>
                <?php else: ?>
                <td style="<?php echo $background;?>" align="center"><span <?php echo $style;?>><?php echo $no;?></span></td>
                <?php endif; ?>
                <td style="<?php echo $background;?>">
                <?php if(!empty($key->foto_pengguna)): ?>
                  <img src="<?php echo base_url().$key->foto_pengguna;?>" class="rounded" style="height:50px;">
                <?php else: ?>
                  <img src="<?php echo base_url('assets/img/user.png')?>" class="rounded" style="height:50px;">
                <?php endif; ?>
                  <span <?php echo $style;?>> <a class="text-<?php echo $color;?>" href="<?php echo base_url('panel/profile/user/'.$key->id_pengguna);?>"><?php echo $key->username;?></a></span>
                </td>
                <td style="<?php echo $background;?>"><span <?php echo $style;?>><?php echo $key->point;?></span></td>
              </tr>
              <?php $no++; endif; ?>
              <?php endforeach;?>
              </tbody>
            </table>
          <?php endif; ?>
          <?php echo $this->session->flashdata('notif'); ?>
        </div>
      </div>
      <!-- end panel -->
    </div>
    <!-- end col-12 -->
  </div>
  <!-- end row -->
</div>
<!-- end #content -->