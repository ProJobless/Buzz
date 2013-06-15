<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $meta_description; ?>" />
	<meta name="robots" content="noindex, nofollow"/>
	<meta name="keywords" content="<?php echo $meta_keywords; ?>" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/login.css" />
	<script src="<?php echo base_url(); ?>js/application.js"></script>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lte IE 7]>
	<script src="js/IE8.js" type="text/javascript"></script><![endif]-->
<!--[if lt IE 7]>
 
	<link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/><![endif]-->
</head>
<body>
	<section class="ls_container">
		<div class="ls_title"><span>Hype Ninja</span>Client Login</div>
		<?php if($error != ""){?><div class="ls_error"><?php echo $error; ?></div><?php } ?>
		<form class="ls_form" action="<?php echo site_url('login/submit'); ?>" method="POST">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button type="submit">Login</button>
		</form>
	</section>	
</body>
</html>