
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?php echo $appsProfile->apps_name; ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() . $appsProfile->icon; ?>">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin register -->
        <div class="register register-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="<?php echo base_url().$appsProfile->sidebar_login;?>" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="fa fa-edit text-success"></i> <?php echo $appsProfile->apps_name;?></h4>
                    <p>
						<?php echo $appsProfile->about_us;?>
					</p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin register-header -->
                <h1 class="register-header">
                    Sign Up
                    <small>Test your potential by registering your account here!</small>
                </h1>
                <!-- end register-header -->
                <!-- begin register-content -->
                <div class="register-content">
					<?php echo $this->session->flashdata('notif');?>
                    <form action="<?php echo base_url('auth/register/doRegister');?>" method="POST" class="margin-bottom-0">
                        <label class="control-label">Username <span class="text-danger">*</span></label>
                        <div class="row row-space-10">
                            <div class="col-md-12 m-b-15">
                                <input type="text" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>" name="username" required/>
								<?php echo form_error('username'); ?>
                            </div>
                        </div>
                        <label class="control-label">Email <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email address" required/>
								<?php echo form_error('email'); ?>
                            </div>
                        </div>
						<label class="control-label">Full Name <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nama_lengkap" value="<?php echo set_value('nama_lengkap'); ?>" placeholder="Full Name" required/>
								<?php echo form_error('nama_lengkap'); ?>
                            </div>
                        </div>
						<label class="control-label">Phone Number <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="no_hp" value="<?php echo set_value('no_hp'); ?>" onkeypress="onlyNumberKey(this.event)" placeholder="Phone Number" required/>
								<?php echo form_error('no_hp'); ?>
                            </div>
                        </div>
                        <label class="control-label">Password <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" id="password" onkeyup="cekPassword()" required/>
								<?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <label class="control-label">Re-type Password <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" class="form-control" placeholder="Re-type Password" value="<?php echo set_value('re_password'); ?>" onkeyup="cekPassword()" id="re_password" name="re_password" required/>
				                <font color="red" id="notifrepass">
									<?php echo form_error('password'); ?>
								</font>
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
                        <div class="register-buttons">
                            <button type="submit" class="btn btn-primary btn-block btn-lg" id="btnSimpan">Sign Up</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                            Already have an account? <a href="<?php echo base_url();?>">Click Here</a> to Log In.
                        </div>
                        <hr />
                        <p class="text-center">
							<?php echo $appsProfile->footer;?>
                        </p>
                    </form>
                </div>
                <!-- end register-content -->
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->
        
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo base_url();?>assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?php echo base_url();?>assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?php echo base_url();?>assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo base_url();?>assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-53034621-1', 'auto');
		ga('send', 'pageview');

	</script>
	<script>
		function onlyNumberKey(evt) {
			var theEvent = evt || window.event;

			// Handle paste
			if (theEvent.type === 'paste') {
				key = event.clipboardData.getData('text/plain');
			} else {
			// Handle key press
				var key = theEvent.keyCode || theEvent.which;
				key = String.fromCharCode(key);
			}
			var regex = /[0-9]|\./;
			if( !regex.test(key) ) {
				theEvent.returnValue = false;
				if(theEvent.preventDefault) theEvent.preventDefault();
			}
		}
	</script>
	<?php $this->load->view('modalLoading');?>
	<script>
		$('#btnSimpan').click(function(){
			$('#modalLoading').modal('show')
   		    $('#modalLoading').modal({backdrop: 'static', keyboard: false})
		})
	</script>
</body>
</html>
