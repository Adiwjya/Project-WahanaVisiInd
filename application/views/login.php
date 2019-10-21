<!DOCTYPE html>
<html lang="en">
    <head>
	<title>Wahana Visi</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/login/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/main.css">
    </head>
    <body>
	<div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="<?php echo base_url(); ?>assets/login/images/img-01.png" alt="IMG">
                    </div>
                    <div class="login100-form validate-form">
                        <span class="login100-form-title">
                            <img src="<?php echo base_url(); ?>images/logo-wahana.png" alt="Logo">
                            <br>
                        </span>
                        <form id="form">
                            <div class="wrap-input100 validate-input" data-validate="Valid username">
                                <input class="input100" type="email" name="email" id="email" placeholder="Username" autocomplete="off">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                <input class="input100" type="password" name="pass" id="pass" placeholder="Password" autocomplete="off">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                        </form>
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn" onclick="login();">
                                Login
                            </button>
                        </div>
                        <div class="text-center p-t-70">
                            <a class="txt2" href="<?php echo base_url(); ?>registrasi">
                                Create your Account
                                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
	</div>
        <script src="<?php echo base_url(); ?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/vendor/select2/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/vendor/tilt/tilt.jquery.min.js"></script>
        <script type="text/javascript">
            $('.js-tilt').tilt({
                scale: 1.1
            })
            
            function login(){
                var email = document.getElementById('email').value;
                var pass = document.getElementById('pass').value;
                if(email === ''){
                    alert("Email tidak boleh kosong");
                }else if(pass === ''){
                    alert("Password tidak boleh kosong");
                }else{
                    $.ajax({
                        url : "<?php echo base_url(); ?>login/proses",
                        type: "POST",
                        data: $('#form').serialize(),
                        dataType: "JSON",
                        success: function(data){
                            if(data.status === "ok"){
                                window.location.href = "<?php echo base_url(); ?>home";
                            }else{
                                alert(data.status);
                            }
                        },error: function (jqXHR, textStatus, errorThrown){
                            alert("Error json " + errorThrown);
                        }
                    });
                }
            }
            
            function addacc(){
                $('#form')[0].reset(); // reset form on modals
                $('#modal_form').modal('show'); // show bootstrap modal
            }
            
	</script>
	<script src="<?php echo base_url(); ?>assets/login/js/main.js"></script>
    </body>
</html>