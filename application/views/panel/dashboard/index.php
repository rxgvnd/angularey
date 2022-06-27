<script src="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/highcharts.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/modules/data.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/modules/exporting.js"></script>
<!-- begin #content -->
<?php if($this->session->userdata('hak_akses') != 'member'){?>
	<div id="content" class="content">
<?php }else{ ?>
	<div id="content" class="content" style="margin-left: 0px;">
<?php } ?>
	<!-- begin row -->
	<div class="col-md-12">
		<div class="row">
			<?php echo $this->session->flashdata('notif'); ?>
			<h3>Selamat <?php echo waktu(date('H')); ?> : <b><?php echo $this->session->userdata('nama_lengkap'); ?></b><br/>
		</div>
	</div>
	<div class="row">
		<?php if ($this->session->userdata('hak_akses') != 'member') : ?>
			<!-- begin col-3 -->
			<div class="col-md-4 col-sm-4">
				<div class="widget widget-stats bg-blue">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-users"></i></div>
					<div class="stats-title">Jumlah Pengguna</div>
					<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlPengguna->jumlah, 0, '.', '.'); ?></a></div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="widget widget-stats bg-green">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-book"></i></div>
					<div class="stats-title">Jumlah Course</div>
					<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlCourse->jumlah, 0, '.', '.'); ?></a></div>
				</div>
			</div>
			<?php else:?>
		<?php endif; ?>
		
		<div class="col-md-12">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Data Diri</h4>
				</div>
				<div class="panel-body">
					<div class="row">
					<div style="display: flex!important;">
					<a class="w-lg-300px w-100px" style="width: 100px!important;box-sizing: border-box;">
						<?php if (!empty($pengguna[0]->foto_pengguna)) : ?>
						<img src="<?php echo base_url() . $pengguna[0]->foto_pengguna; ?>" alt="" class="mw-100 rounded-pill" style="border-radius: 4px!important;max-width: 100%!important;vertical-align: middle;"/>
						<?php else : ?>
						<img src="<?php echo base_url('assets/img/user.png'); ?>" alt="" class="mw-100 rounded-pill" style="border-radius: 4px!important;max-width: 100%!important;vertical-align: middle;"/>
						<?php endif; ?>
					</a>
					<div class="flex-1 ps-3" style="flex: 1;padding-left: 0.9375rem!important;">
					<div class="col-md-6">
					<div class="table-responsive">
					<table class="table table-striped table-bordered" width="100%">
						<tr>
							<td style="margin-bottom:1rem">Username</td>
							<td style="margin-left:2rem;margin-bottom:1rem;margin-right:3rem;"> : <?php echo $pengguna[0]->username?></td>
						</tr>
						<tr>
							<td style="margin-bottom:1rem">Nama Lengkap</td>
							<td style="margin-left:2rem;margin-bottom:1rem;margin-right:3rem;"> : <?php echo $pengguna[0]->nama_lengkap?></td>
						</tr>
						<tr>
							<td style="margin-bottom:1rem">No Hp</td>
							<td style="margin-left:2rem;margin-bottom:1rem;margin-right:3rem;"> : <?php echo $pengguna[0]->no_hp?></td>
						</tr>
						<tr>
							<td style="margin-bottom:1rem">Tanggal Lahir</td>
							<td style="margin-left:2rem;margin-bottom:1rem;margin-right:3rem;"> : <?php echo $pengguna[0]->tgl_lahir?></td>
						</tr>
					</table>
					</div>
					</div>

					<div class="col-md-6">
					<div class="table-responsive">
					<table class="table table-striped table-bordered" width="100%">
						<tr>
							<td style="margin-bottom:1rem">Alamat</td>
							<td style="margin-left:2rem;margin-bottom:1rem;margin-right:3rem;"> : <?php echo $pengguna[0]->alamat?></td>
						</tr>
						
						<tr>
							<td style="margin-bottom:1rem">Email</td>
							<td style="margin-left:2rem;margin-bottom:1rem;margin-right:3rem;"> : <?php echo $pengguna[0]->email?></td>
						</tr>
					</table>
					</div>
					</div>

					</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<div class="col-md-6">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">MENU</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-body bg-silver">
									<div class="row">
										<div class="col-md-4 col-sm-6 col-xs-6">
												<a href="<?php echo base_url('panel/dashboard');?>" class="btn btn-md btn-block blue-rasp text-white"><i class="fa fa-dashboard"></i><br><small class="text-white">Dashboard</small></a>
											<br>
										</div>
										<?php if(cekModul('pengguna') == true): ?>
										<div class="col-md-4 col-sm-6 col-xs-6">
											<a href="<?php echo base_url('panel/masterData/pengguna');?>" class="btn btn-md btn-block blue-rasp text-white"><i class="fa fa-users"></i><br><small class="text-white">Pengguna</small></a>
											<br>
										</div>
										<?php endif; ?>
										<?php if(cekModul('hakAkses') == true): ?>
										<div class="col-md-4 col-sm-6 col-xs-6">
											<a href="<?php echo base_url('panel/masterData/hakAkses');?>" class="btn btn-md btn-block blue-rasp text-white"><i class="fa fa-user-secret"></i><br><small class="text-white">Hak Akses</small></a>
											<br>
										</div>
										<?php endif; ?>
										<div class="col-md-4 col-sm-6 col-xs-6">
											<a href="<?php echo base_url('auth/logout');?>" class="btn btn-md btn-block btn-danger"><i class="fa fa-sign-out"></i><br><small class="text-white">Keluar</small></a>
											<br>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if(cekModul('pengguna') == true): ?>
		<div class="col-md-6">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">5 Pengguna Baru</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="table" class="table table-striped table-bordered" width="100%">
							<thead>
								<tr>
									<th>NO</th>
									<th>Nama Pengguna</th>
									<th>Username</th>
									<th>Waktu Daftar</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($penggunaBaru as $key):?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $key->nama_lengkap;?></td>
									<td><?php echo $key->username;?></td>
									<td><?php echo $key->created_time;?></td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<?php echo $this->session->flashdata('notif'); ?>
	<!-- end row -->
</div>
<!-- end #content -->