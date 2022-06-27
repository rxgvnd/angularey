<?php foreach($course as $key):?>
<!-- begin #content -->
<div id="content" class="content" style="margin-left: 0px;">
	<!-- begin row -->
	<div class="col-md-2">
		<a href="<?php echo base_url('panel/course');?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left"></i> BACK</a>
	</div>
	<div class="col-md-8">
		<div class="panel panel-inverse">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel bg-black">
							<div class="panel-body">
								<h3 class="text-center text-white"><?php echo $key->nama_course;?></h3>
							</div>
						</div>
						<div class="timeline">
							<?php $no=1; foreach($lessons as $row):?>
							<?php $getSoal = $this->GeneralModel->get_by_multi_id_general('v_soal','course',$row->course,'materi',$row->id_materi);?>
							<div class="timeline-icon">
								<img src="<?php echo base_url().$row->gambar_course;?>" class="img-responsive" alt="">
							</div>
							<div class="timeline-content animate__animated animate__backInDown animate__delay-<?php echo $no++;?>s">
								<div class="timeline-body">
									<div class="panel panel-inverse">
										<div class="panel-heading bg-cyan">
											<?php echo $row->nama_materi;?> | Soal <?php echo $row->jmlSoal;?>
										</div>
										<div class="panel-body" style="background-color:#e0dcdc">
											<div class="row">
												<?php $no2=4; foreach($getSoal as $gs):?>
													<div class="col-md-6 animate__animated animate__fadeIn">
														<div class="panel bg-black">
															<div class="panel-heading text-white">
																<?php if($gs->tipe_soal != 'narasi'): ?>
																	<i class="fa fa-edit"></i> <?php echo $gs->urutan_soal;?> SOAL
																<?php else: ?>
																	<i class="fa fa-book"></i> <?php echo $gs->urutan_soal;?> NARASI
																<?php endif; ?>
															</div>
															<div class="panel-footer" style="background-color:#f2e9e9">
																<?php if(cekSoal($gs->urutan_soal,$row->id_materi,$row->course)==TRUE): ?>
																	<a href="<?php echo base_url('panel/course/training/'.$gs->urutan_soal.'/'.$row->id_materi.'/'.$row->course);?>" class="btn btn-success btn-sm btn-block">DETAIL</a>
																<?php else: ?>
																	<a href="#" class="btn btn-success btn-sm btn-block" disabled>LOCKED</a>
																<?php endif; ?>
															</div>
														</div>
													</div>
												<?php endforeach;?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach;?>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<div class="col-md-2"></div>
</div>
<!-- end #content -->
<?php endforeach;?>
