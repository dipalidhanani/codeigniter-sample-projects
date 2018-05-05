<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->config->item('COMPANY_NAME'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url("public/validator/css/validationEngine.jquery.css");?>" type="text/css"/>
        <script src="<?php echo base_url("public/js/jquery-1.8.3.min.js");?>" type="text/javascript"></script>
<script src="<?php echo base_url("public/validator/js/languages/jquery.validationEngine-en.js");?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("public/validator/js/jquery.validationEngine.js");?>" type="text/javascript" charset="utf-8"></script>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to <?php echo $this->config->item('COMPANY_NAME'); ?></h1>
        <image src="<?php echo base_url("public/images/logo.png"); ?>" />
	<div id="body">
            <?php if( isset($success)){ ?>
            <div id="err_div" style="color:green;"><?php echo $success; ?></div>
            
            <?php }elseif( isset($error) || isset($uname)){ ?>
            <div id="err_div" style="color:red;"><?php echo $uname; ?></div>
            <div id="err_div" style="color:red;"><?php echo $error; ?></div>
            <?php } ?>
            <form  method="post" action="<?php echo base_url("kaizen/welcome/authentication/"); ?>" id="login_frm"  />
                <div>User Name</div>
                <input type="text" name="uname" id="uname" value="" class="validate[required]" />
                <div>Password</div>
                <input type="password" name="pwd" id="pwd" value="" class="validate[required]" />
                <div></div>
                <input name="" type="submit" class="submitBtn" value="Login" />
                
                <a href="<?php echo base_url("kaizen/forgot_pwd"); ?>">Forgot Password</a>
        </form>
	</div>

	
</div>

</body>
</html>