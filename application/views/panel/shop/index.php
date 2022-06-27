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
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
        <div class="container">
        <?php foreach($produk as $key):?>
					<div class="col-md-4 m animate__animated animate__backInDown">
						<div class="panel box">
							<div class="panel-body">
								<h2 class="text-center">GET <?php echo $key->jumlah_hint;?> Hint</h2>
								<center>
									<img src="<?php echo base_url('assets/icon/hint'.$key->jumlah_hint.'.png');?>" class="rounded img-responsive">
								</center>
								<hr>	
								<dl>
									<dd class="text-center">
  									<img src="<?php echo base_url('assets/icon/pizza.png');?>" style="width:20px">
                    <?php echo number_format($key->harga,0,'.','.');?> Pizza</dd>
								</dl>
							</div>
							<div class="panel-footer" id="btnCourse">
										<a href="<?php echo base_url('panel/shop/buyProduk/'.$key->id_produk);?>" title="finishing previous level" class="btn btn-primary btn-md btn-block">BUY NOW!</a>
							</div>
						</div>
					</div>
        <?php endforeach;?>
        </div>
        </div>
      </div>
      <!-- end panel -->
    </div>
    <!-- end col-12 -->
  </div>
  <!-- end row -->
</div>
<!-- end #content -->