<!-- begin #content -->
	<div id="content" class="content" style="margin-left: 0px;">
	<!-- begin row -->
	<div class="col-md-2">
		<br>
		<br>
	</div>
	<div class="col-md-8">
		<h3 class="text-center">Hello, <?php echo $this->session->userdata('username');?></h3>
		<div class="panel panel-inverse">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-body bg-blue">
								<h3 class="text-center text-white">What would you like to learn?</h3>
							</div>
						</div>
						<?php echo $this->session->flashdata('notif');?>
					</div>
					<?php $no=1; foreach($course as $key):?>
					<div class="col-md-3 animate__animated animate__backInDown animate__delay-<?php echo $no++;?>s">
						<div class="panel box">
							<div class="panel-body">
								<h5 class="text-center"><?php echo $key->nama_course;?></h5>
								<center>
									<img src="<?php echo base_url().$key->gambar_course;?>" class="rounded img-responsive">
								</center>
								<hr>	
								<dl>
									<dd class="text-center"><?php echo $key->keterangan_course;?></dd>
									<dd class="text-center"><img src="<?php echo base_url('assets/icon/online-lesson.png');?>" style="width:25px;"> <?php echo $key->jmlMateri;?> Lesson </dd>
								</dl>
							</div>
							<div class="panel-footer" id="btnCourse">
									<?php if(cekLevel($key->id_course) == TRUE): ?>
										<a href="<?php echo base_url('panel/course/learn/'.$key->id_course);?>" class="btn btn-danger btn-md btn-block">Learn Now!</a>
									<?php else: ?>
										<a disabled href="#" title="finishing previous level" class="btn btn-danger btn-md btn-block">Locked</a>
									<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		</div>		
	</div>
	<div class="col-md-2"></div>
</div>
<!-- end #content -->

