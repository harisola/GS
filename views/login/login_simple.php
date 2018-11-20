<!doctype html>
<html lang="en">
<head>
	<title>
		Generation's School
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php $this->load->helper('url'); ?>
	<link rel="stylesheet" href="<?php echo base_url()?>components/css/bootstrap.css" />	
	<link rel="stylesheet" href="<?php echo base_url()?>components/css/notifIt.css" />


	<script src="<?php echo base_url()?>components/js/bootstrap.js"></script>
	<script src="<?php echo base_url()?>components/js/jquery-2.1.1.js"></script>		
	<script src="<?php echo base_url()?>components/js/notifIt.js"></script>
</head>


<body>
	<style>

	    @font-face { font-family: 'Cooper Black'; src: url('<?php echo base_url()?>components/fonts/cooper_black.eot'); src: url('<?php echo base_url()?>components/fonts/cooper_black.eot?#iefix') format('embedded-opentype'), url('<?php echo base_url()?>components/fonts/cooper_black.svg#Cooper Black') format('svg'), url('<?php echo base_url()?>components/fonts/cooper_black.woff') format('woff'), url('<?php echo base_url()?>components/fonts/cooper_black.ttf') format('truetype'); font-weight: normal; font-style: normal;}

	    .bootshape {
	      font-family: 'Alef', sans-serif;
	      background-color: #FFF;
	      text-align: center;
	      color: #333;
	    }
	    .bootshape a,
	    .bootshape a:hover,
	    .bootshape a:focus {
	      color: #dd745c;
	    }
	    .bootshape h1 {
	      color: #dd745c;
	      font-family: 'Cooper Black';
	      padding-bottom: 20px;
	      font-weight: bold;
	    }
	    .bootshape .form-control {
	      background-color: #f1f0f0;
	      border-radius: 0;
	      border: none;
	      margin: 0 0 10px 0;
	      color: #333;
	      box-shadow: none;
	      height: 62px;
	      font-family: 'Alef', sans-serif;
	      text-align: center;
	      font-size: 22px;
	    }
	    .bootshape .form-control:focus {
	      border-color: #e4e0e0;
	      outline: 0;
	      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.015), 0 0 8px rgba(228, 224, 224, 0.6);
	      -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.015), 0 0 8px rgba(228, 224, 224, 0.6);
	      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.015), 0 0 8px rgba(228, 224, 224, 0.6);
	    }
	    .bootshape .btn-lg {
	      font-size: 22px;
	      height: 62px;
	      border-radius: 0;
	      background-color: #dd745c;
	      border: 0;
	      text-transform: uppercase;
	    }
	    .bootshape .btn-primary:hover,
	    .bootshape .btn-primary:focus {
	      background-color: #ba523a;
	    }
	    .bootshape .forgot-password {
	      padding-top: 20px;
	      text-decoration: underline;
	      color: #333;
	      font-size: 18px;
	    }
	    .bootshape .forgot-password a {
	      color: #333;
	    }
	    .bootshape .footer {
	      padding: 20px 0;
	    }
	    .bootshape .simple-login {
	      margin: 0 auto;
	      max-width: 500px;
	      padding: 100px 15px 15px 15px;
	    }
	</style>


	<script type="text/javascript">
	function not2(){
	  notif({
	    msg: "Username OR Password mismatched!",
	    type: "error",
	    position: "center"
	  });
	}

	$(function(){
	  $("#login_form").submit(function(){
	      $.post($('#login_form').attr('action'),$('#login_form').serialize(),function(json){
	      	if(json.st == 1) {	      		
				window.location.href = '<?=site_url('dashboard/dashboard')?>';					
	      	} else {
	      		not2();
	      	}
	      }, 'json');	  
	      return false;
      });
	});
	</script>
	
	<section>
	    <div class="container bootshape">
	        
	        <?php 	$attributes = array('class' => 'simple-login', 'id' => 'login_form');
	        		echo form_open('welcome/logininfo', $attributes); ?>

            <h1>Generation's School</h1>
	        
	        <?php echo form_input(array(
	        	'name' => 'username',
	        	'type' => 'text',
	        	'placeholder' => 'Username',
	        	'class' => 'form-control',
	        	'required' => 'required',
	        	'autofocus' => 'autofocus',
	        )); ?>
	         
	        <?php echo form_input(array(
	        	'name' => 'password',
	        	'type' => 'password',
	        	'required' => 'required',
	        	'placeholder' => 'Password',
	        	'class' => 'form-control',
	        )); ?>
	        
	        <?php echo form_submit(array(
	        	'type' => 'submit',
	        	'value' => 'Login',
	        	'class' => 'btn btn-lg btn-danger btn-block',
	        )); ?>
	        
	        <?php echo form_close(); ?>
	    </div>
	</section>	
</body>
</html>