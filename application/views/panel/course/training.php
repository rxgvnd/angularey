<?php foreach($course as $key):?>
<?php foreach($soal as $row):?>
<?php $cekHint = $this->GeneralModel->get_by_multi_id_general('at_hint','pengguna',$this->session->userdata('id_pengguna'),'soal',$row->id_soal);?>
<!-- begin #content -->
<div id="content" class="content" style="margin-left: 0px;">
	<!-- begin row -->
	<div class="col-md-2">
	</div>
	<div class="col-md-8">
		<div class="panel panel-inverse">
			<div class="panel-body">
				<div class="row" id="panelSoal">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="panel bg-black">
								<div class="panel-body">
										<h5 class="text-center text-white"><?php echo $key->nama_course;?></h5>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel bg-black">
								<div class="panel-body">
									<h5 class="text-center text-white"><?php echo $key->nama_materi;?></h5>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="panel bg-black">
								<div class="panel-body">
									<?php if($row->tipe_soal != 'narasi'): ?>
										<h5 class="text-center text-white">Question No.<?php echo $row->urutan_soal;?></h5>
									<?php else: ?>
										<h5 class="text-center text-white">Learning Time</h5>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="panel bg-silver">
								<div class="panel-body">
									<?php if($row->tipe_soal == 'essay'): ?>
										<?php echo str_replace('_','<input type="text" name="jawaban[]" class="code_input">',$row->isi_soal);?>
									<?php else: ?>
										<?php echo $row->isi_soal;?>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<input type="hidden" name="tipe_jawaban" value="<?php echo $row->tipe_soal;?>">
						<?php if($row->tipe_soal == 'pilgan'): ?>
							<div class="col-md-12">
								<div class="panel bg-silver">
									<div class="panel-body">
						                <input class="form-check-input" value="A" type="radio" name="jawaban" id="jawaban_a">
										<label class="form-check-label" for="jawaban_a">
											A. <?php echo str_replace("<p>","",$row->jawaban_a);?>
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="panel bg-silver">
									<div class="panel-body">
						                <input class="form-check-input" value="B" type="radio" name="jawaban" id="jawaban_b">
										<label class="form-check-label" for="jawaban_b">
											B. <?php echo str_replace("<p>","",$row->jawaban_b);?>
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="panel bg-silver">
									<div class="panel-body">
						                <input class="form-check-input" value="C" type="radio" name="jawaban" id="jawaban_c">
										<label class="form-check-label" for="jawaban_c">
											C. <?php echo str_replace("<p>","",$row->jawaban_c);?>
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="panel bg-silver">
									<div class="panel-body">
						                <input class="form-check-input" value="D" type="radio" name="jawaban" id="jawaban_d">
										<label class="form-check-label" for="jawaban_d">
											D. <?php echo str_replace("<p>","",$row->jawaban_d);?>
										</label>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<?php foreach($cekHint as $ch):?>
							<div class="col-md-12">
								<div class="panel bg-green text-white">
									<div class="panel-body">
										The answer is : <br>
										<?php echo $row->kunci_jawaban;?>
										<?php echo $row->jawaban_essay;?>
									</div>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>		
	</div>
		<div class="col-md-2">
		</div>
</div>

<div id="footer" class="container">
    <nav class="navbar navbar-fixed-bottom  navbar-inverse">
        <div class="navbar-inner navbar-content-center">
			<ul class="nav navbar-nav">
				<li>
					<?php if($row->urutan_soal > 1): ?>
						<?php if(cekPrevSoal($key->course,$key->id_materi,$row->urutan_soal) == TRUE): ?>
							<a href="<?php echo base_url('panel/course/training/'.($row->urutan_soal-1).'/'.$key->id_materi.'/'.$key->course);?>" class="bg-red text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-left"></i> BACK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
						<?php else: ?>
							<?php $lastMateri = $this->db->query("SELECT max(id_materi) as id_materi FROM at_materi WHERE course = '$key->course' AND id_materi < '$key->id_materi'")->row();?>
							<a href="<?php echo base_url('panel/course/training/'.($row->urutan_soal-1).'/'.$lastMateri->id_materi.'/'.$key->course);?>" class="bg-red text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-left"></i> BACK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
						<?php endif; ?>
					<?php else: ?>
						<a href="<?php echo base_url('panel/course/lessons/'.$key->course);?>" class="bg-red text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-left"></i> BACK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
					<?php endif; ?>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-center">
				<?php if($row->tipe_soal!='narasi'): ?>
					<?php if($cekHint): ?>
					<?php else: ?>
						<li>
							<a href="#" onclick="getHint()" class="text-white bg-red"><img src="<?php echo base_url('assets/icon/lightbulb.png');?>" style="width:15px;"> HINT</a>
						</li>
					<?php endif; ?>
					<li>
						<a href="#" class="text-white bg-orange"><img src="<?php echo base_url('assets/icon/clock.png');?>" style="width:15px;">&nbsp;&nbsp;<span id="timer"></span></a>
					</li>
					<li>
						<a href="#" onclick="simpanJawaban()" class="text-white bg-primary"><img src="<?php echo base_url('assets/icon/check-mark.png');?>" style="width:15px;"> Submit </a>
					</li>
				<?php endif; ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if(cekSoal($nextSoal,$key->id_materi,$key->course) == TRUE): ?>
					<li>
						<?php if(cekNextSoal($key->course,$key->id_materi,$nextSoal) == TRUE): ?>
							<a href="<?php echo base_url('panel/course/training/'.$nextSoal.'/'.$key->id_materi.'/'.$key->course);?>" class="bg-green text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT <i class="fa fa-arrow-right"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
						<?php else:
							$nextMateri = $this->db->query("SELECT min(id_materi) as id_materi FROM at_materi WHERE course = '$key->course' AND id_materi > '$key->id_materi'")->row();
						?>
							<?php if(!empty($nextMateri->id_materi)): ?>
								<a href="<?php echo base_url('panel/course/training/'.$nextSoal.'/'.$nextMateri->id_materi.'/'.$key->course);?>" class="bg-green text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT <i class="fa fa-arrow-right"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
							<?php else: ?>
								<a href="<?php echo base_url('panel/course/');?>" class="bg-green text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-check"></i> GOOD JOB !! YOU HAD FINISHED ALL TRAINING !!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
							<?php endif; ?>
						<?php endif; ?>
					</li>
				<?php endif; ?>
			</ul>
        </div>
    </nav>
</div>
<!-- end #content -->
<?php if($row->tipe_soal!='narasi'): ?>
<script>
	function startTimer(duration, display) {
	var timer = duration, minutes, seconds;
	setInterval(function () {
			localStorage.setItem('timer',timer);
			minutes = parseInt(timer / 60, 10);
			seconds = parseInt(timer % 60, 10);

			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;
			if (minutes == 00 && seconds < 30) {
			display.html('<b class="text-danger">'+minutes + ":" + seconds+"</b>");
				if (minutes == 00 && seconds == 00) {
					display.html('<b class="text-white" style="font-weight:bold;margin-bottom:15px;margin-top:16px;">'+minutes + ":" + seconds+"</b>");
					updateWaktu();
				}
				}else{
					display.html('<b class="text-white" style="font-weight:bold;margin-bottom:15px;margin-top:16px;">'+minutes + ":" + seconds+"</b>");
				}

			if (--timer < 0) {
				timer = duration;
			}
		}, 1000);
	}

	function stopTimer(){
		<?php if(!empty($cekTimer[0]->used_time)): ?>
			var timer = (60 * <?php echo $cekTimer[0]->used_time/60;?>)
		<?php else: ?>
			var timer = (60 * localStorage.timer/60)
		<?php endif; ?>
		minutes = parseInt(timer / 60, 10);
		seconds = parseInt(timer % 60, 10);
		display = $('#timer');

		minutes = minutes < 10 ? "0" + minutes : minutes;
		seconds = seconds < 10 ? "0" + seconds : seconds;
		if (minutes == 00 && seconds < 30) {
		display.html('<b class="text-danger">'+minutes + ":" + seconds+"</b>");
				if (minutes == 00 && seconds == 00) {
					display.html('<b class="text-white" style="font-weight:bold;margin-bottom:15px;margin-top:16px;">'+minutes + ":" + seconds+"</b>");
					updateWaktu();
				}
		}else{
			display.html('<b class="text-white" style="font-weight:bold;margin-bottom:15px;margin-top:16px;">'+minutes + ":" + seconds+"</b>");
		}
		clearInterval()
	}

	jQuery(function ($) {
		var usingMinutes;
		<?php if($cekTimer): ?>
			<?php if($cekTimer[0]->used_time > 0): ?>
				usingMinutes = <?php echo $row->time - $cekTimer[0]->used_time;?>;
			<?php else: ?>
				usingMinutes = 0;
			<?php endif; ?>
		<?php else: ?>
				usingMinutes = 0;
		<?php endif; ?>
		var time = <?php echo $row->time/60;?>;
		var minutes = (60 * time) - usingMinutes;
		display = $('#timer');
		if (minutes > 0) {
			<?php if($cekTimer[0]->finish_soal == 'Y'): ?>
				stopTimer();
			<?php else: ?>
				startTimer(minutes, display);
			<?php endif; ?>
		}else{
			$('#timer').html('<b class="text-danger" style="font-weight:bold;margin-bottom:15px;margin-top:16px;">00:00</b>');
		}
	});
</script>
<script>
  function updateWaktu(){
    // ------------ UPDATING TIMER -------------//
    $.ajax({
      url:'<?php echo base_url('panel/course/updateWaktu');?>',
      type:'POST',
      data:{
        'timer':localStorage.timer,
        'course':'<?php echo $key->course;?>',
		'materi':'<?php echo $key->id_materi;?>',
		'urutan_soal':'<?php echo $row->urutan_soal;?>'
      },success:function(){
        // console.log('timer updated');
      }
    })    
  }
</script>
<script>
$(document).ready(function(){
	<?php if($row->tipe_soal=='pilgan'): ?>
	<?php else: ?>
		<?php if($cekTimer): ?>
			<?php if(!empty($cekTimer[0]->jawaban_soal)): ?>
				<?php 
				$jawaban_soal = json_decode($cekTimer[0]->jawaban_soal);
				for($i=0;$i<count($jawaban_soal);$i++): ?>
					$('input[name="jawaban[]"]').eq(<?php echo $i;?>).val('<?php echo $jawaban_soal[$i];?>')
				<?php endfor; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
})


function simpanJawaban(){
	<?php if($row->tipe_soal=='pilgan'): ?>
	    var jawaban = $('input[name="jawaban"]:checked').val();
		var dataJawaban = jawaban;
	<?php else: ?>
		var dataJawaban = [] 
	    var jawaban = $('input[name="jawaban[]"]').map( function(key){
			console.log(key+':'+$(this).val());
			dataJawaban[key] = $(this).val();
		});
		console.log(dataJawaban);
	<?php endif; ?>
		if (jawaban!=undefined && jawaban!='') {
		$.ajax({
			url:'<?php echo base_url('panel/course/simpanJawaban');?>',
			type:'POST',
			data:{
				'course':'<?php echo $key->course;?>',
				'materi':'<?php echo $key->id_materi;?>',
				'urutan_soal':'<?php echo $row->urutan_soal;?>',
				'used_time':localStorage.timer,
				'tipe_soal':'<?php echo $row->tipe_soal;?>',
				'jawaban':dataJawaban
			},success:function(resp){
			if (resp!='false' && resp!='denied') {
				updateWaktu();
				var data = JSON.parse(resp);
				Swal.fire(
					'Finished',
					'Congrats! Your answer true! You earning <br><br><div class="row"><div class="col-md-4"><img src="<?php echo base_url('assets/icon/point.png');?>" style="width:50px"><br><br>'+
					data.earned_point+' Points</div><div class="col-md-4"><img src="<?php echo base_url('assets/icon/exp.png');?>" style="width:50px"><br><br>'+data.earned_exp+' Exp</div><div class="col-md-4"><img src="<?php echo base_url('assets/icon/pizza.png');?>" style="width:50px"><br><br>'+data.earned_pizza+' Pizza</div></div>',
					'success'
				).then(function(){
					location.reload();
				})
			}else if(resp=='denied'){
				Swal.fire({
					type: 'error',
					title: 'Access Denied',
					text: 'Sorry you have done answer this question!',
				})
			}else{
				Swal.fire({
					type: 'error',
					title: 'Wrong',
					text: 'Sorry please check again your answer..',
				})
			}
			},error:function(){
				Swal.fire({
					type: 'error',
					title: 'Oopss..',
					text: 'Something wrong',
				})
			}
		})
		}else{
			Swal.fire({
				type: 'error',
				title: 'The answer is empty',
				text: 'The answer cant empty',
			})
	}
}
</script>
<script>
	function getHint(){
		$.ajax({
			url:"<?php echo base_url('panel/course/getHint/');?>",
			type:'POST',
			data:{
				'course':'<?php echo $key->course;?>',
				'materi':'<?php echo $key->id_materi;?>',
				'urutan_soal':'<?php echo $row->urutan_soal;?>',
			},success:function(resp){
				if(resp!='false'){
					updateWaktu();
					var data = JSON.parse(resp);
					Swal.fire(
						'Success',
						'You are using 1 hint to see the answer',
						'success'
					).then(function(){
						location.reload();
					})
				}else{
					Swal.fire({
						type: 'error',
						title: 'Failed',
						text: 'Your hint is not enough or hint not found',
					})
				}
			}
		})
	}
</script>
<?php endif; ?>
<?php endforeach;?>
<?php endforeach;?>
