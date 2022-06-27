<div id="content" class="content" style="margin-left: 0px;">
	<!-- begin row -->
	<div class="col-md-12">
		<br>
		<br>
			<?php echo $this->session->flashdata('notif'); ?>
	</div>
	<div class="col-md-6">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<h4 class="panel-title">Top 10 Leaderboard</h4>
			</div>
			<div class="panel-body">
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
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<h4 class="panel-title">Friends</h4>
			</div>
			<div class="panel-body">
				<table id="table3" class="table table-striped table-bordered" width="100%">
					<thead>
					<tr>
						<th>USERNAME</th>
					</tr>
					</thead>
					<tbody>
					<?php $no=1; foreach($global as $key):?>
					<?php $cekFriends = $this->PenggunaModel->cekFriends($this->session->userdata('id_pengguna'),$key->id_pengguna);?>
					<?php if(!empty($cekFriends)): ?>
						<tr>
							<td>
								<?php if(!empty($key->foto_pengguna)): ?>
									<img src="<?php echo base_url().$key->foto_pengguna;?>" class="rounded" style="height:50px;">
								<?php else: ?>
									<img src="<?php echo base_url('assets/img/user.png')?>" class="rounded" style="height:50px;">
								<?php endif; ?>
									<a href="<?php echo base_url('panel/profile/user/'.$key->id_pengguna);?>" style="font-size:15px;"><?php echo $key->username;?></a>
								</td>
							</td>
						</tr>
					<?php endif; ?>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<h4 class="panel-title">Friend Request</h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<table class="table table-bordered table-striped" id="table2">
								<thead>
									<tr>
										<td>Username</td>
										<td>Full Name</td>
										<td width="20%">Action</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach($newRequest as $key):?>
										<tr>
											<td><?php echo $key->username1;?></td>
											<td><?php echo $key->nama_lengkap1;?></td>
											<td>
												<a href="<?php echo base_url('panel/profile/userConfirm/'.$key->pengguna_1);?>" class="btn btn-primary btn-md">Confirm</a>
											</td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- end row -->
</div>
<script>
	$('#table').DataTable()
	$('#table2').DataTable()
	$('#table3').DataTable()
</script>
<!-- end #content -->

<?php if($getEaster): ?>
<?php foreach($getEaster as $key):?>
<?php if($key->jumlah_klik == 10 && $key->notif == 'N'): ?>
<script>
	$(document).ready(function(){
		$('#modalPresent').modal('show')
		offEaster()
	})
	function offEaster(){
		$.ajax({
			url:"<?php echo base_url('panel/dashboard/addEaster/updateNotif');?>",
			type:"POST",
			success:function(){
			}
		})
	}
</script>

<!-- Modal -->
<div id="modalPresent" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  	<img src="<?php echo base_url('assets/img/gift.gif');?>" style="width:100%" alt="">
		<h4 class="text-center">Congrats! You've unlock the easter egg</h4>
		<h4 class="text-center">You get 100 Exp and 5 Pizza</h4>
      </div>
    </div>

  </div>
</div>
<?php endif; ?>
<?php endforeach;?>
<?php endif; ?>