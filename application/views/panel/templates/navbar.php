<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
  <!-- begin #header -->
  <div id="header" class="header navbar navbar-default navbar-fixed-top navbar-inverse">
    <!-- begin container-fluid -->
    <div class="container-fluid">
      <!-- begin mobile sidebar expand / collapse button -->
      <div class="navbar-header">
        <?php if($this->session->userdata('hak_akses') != 'member'): ?>
        <a href="<?php echo base_url(changeLink('panel/dashboard/'));?>" class="navbar-brand text-white" style="font-weight:bold"><?php echo $apps_name;?> <?php echo $apps_version;?></a>
          <button class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar" style="background: #fff;"></span>
            <span class="icon-bar" style="background: #fff;"></span>
            <span class="icon-bar" style="background: #fff;"></span>
          </button>
        <?php else:
          $cekEaster = $this->GeneralModel->get_by_multi_id_general('at_easter','pengguna',$this->session->userdata('id_pengguna'),'status','Y');
        ?>
        <?php if($cekEaster): ?>
          <?php $addBg = "bg-red";?>
        <?php else: ?>
          <?php $addBg = "";?>
        <?php endif; ?>
        <a href="#" onclick="getEaster()" class="navbar-brand <?php echo $addBg;?> text-white" style="font-weight:bold"><?php echo $apps_name;?> <?php echo $apps_version;?></a>
        <?php endif;?>
      </div>
      <!-- end mobile sidebar expand / collapse button -->

      <!-- begin header navigation right -->
      <?php if($this->session->userdata('hak_akses') == 'member'): ?>
      <ul class="nav navbar-nav">
        <li class="<?php if($title == 'Leaderboard'){ echo 'active';};?>">
          <a href="<?php echo base_url('panel/leaderboard');?>">Leaderboard</a>
        </li>
        <li class="<?php if($title == 'Course'){ echo 'active';};?>">
          <a href="<?php echo base_url('panel/course');?>">Course</a>
        </li>
        <li class="<?php if($title == 'Shop'){ echo 'active';};?>">
          <a href="<?php echo base_url('panel/shop/');?>">Shop</a>
        </li>
      </ul>
      <?php endif;?>

      <ul class="nav navbar-nav navbar-right">
        <?php if($this->session->userdata('hak_akses') == 'member'): ?>
          <li class="divider"></li>
        <li>
          <a href="javascript;;" class="text-white"><img src="<?php echo base_url('assets/icon/lightbulb.png');?>" style="width:15px;"> : <?php echo number_format($this->session->userdata('hint'),0,'.','.');?></a>
        </li>
          <li class="divider"></li>
        <li>
          <a href="javascript;;" class="text-white"><img src="<?php echo base_url('assets/icon/exp.png');?>" style="width:15px;"> : <?php echo number_format($this->session->userdata('exp'),0,'.','.');?></a>
        </li>
            <li class="divider"></li>
        <li>
          <a href="javascript;;" class="text-white"><img src="<?php echo base_url('assets/icon/point.png');?>" style="width:15px;"> : <?php echo number_format($this->session->userdata('point'),0,'.','.');?></a>
        </li>
            <li class="divider"></li>
        <li>
          <a href="javascript;;" class="text-white"><img src="<?php echo base_url('assets/icon/pizza.png');?>" style="width:15px;"> : <?php echo number_format($this->session->userdata('pizza'),0,'.','.');?></a>
        </li>
        <?php endif; ?>
        <li class="dropdown navbar-user">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <?php if (!empty($this->session->userdata('foto_pengguna'))): ?>
                <img src="<?php echo base_url().$this->session->userdata('foto_pengguna');?>" alt="" style="border:1px solid #fff" />
              <?php else: ?>
                <img src="<?php echo base_url('assets/img/user.png');?>" alt="" style="border:1px solid #fff" />
            <?php endif; ?>
            <span class="hidden-xs text-white" style="font-weight: bold;"><?php echo $this->session->userdata('nama_lengkap');?></span> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInLeft">
            <li class="arrow"></li>
            <li><a href="<?php echo base_url(changeLink('panel/profile/'));?>">Edit Profile</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('auth/logout');?>">Log Out</a></li>
          </ul>
        </li>
      </ul>
      <!-- end header navigation right -->
      <div class="navbar-nav hidden-md hidden-lg" style="padding-top: 10px;">
        <div class="navbar-item">          
            <a href="<?php echo base_url(changeLink('panel/dashboard/'));?>" class="navbar-link btn blue-rasp text-white"><i class="fa fa-home"></i> Dashboard</a>
        </div>
      </div>
    </div>
    <!-- end container-fluid -->
  </div>