<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $meta_description; ?>" />
	<meta name="robots" content="noindex, nofollow"/>
	<meta name="keywords" content="<?php echo $meta_keywords; ?>" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/application.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.min.css" />
	<script src="<?php echo base_url(); ?>js/application.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js"></script>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lte IE 7]>
	<script src="js/IE8.js" type="text/javascript"></script><![endif]-->
<!--[if lt IE 7]>
 
	<link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/><![endif]-->
</head>
<body>
	<header>
	    <div class="navbar navbar-inverse navbar-static-top">
	    	<div class="navbar-inner">
				<div class="ls_container">
		    		<a class="brand" href="#"><?php echo $title; ?></a>
			   		 <ul class="nav pull-right">
			    		 <li class="<?php if($active == 'dashboard') { echo 'active'; }?>"><?php echo anchor('dashboard', 'Dashboard', 'title="Dashboard"');?></li>	 
			    		 <li class="<?php if($active == 'settings') { echo 'active'; }?>"><?php echo anchor('settings', 'Settings', 'title="Settings"');?></li>	 
						 <li class="<?php if($active == 'faq') { echo 'active'; }?>"><a href="#">FAQ</a></li>
						 <li class=""><?php echo anchor('login/logout', 'Logout', 'title="Logout"');?></li>
			    	 </ul>
			 	</div>
	    	</div>
	    </div>
	</header>
	<div class="sidebar-background">
	  <div class="primary-sidebar-background"></div>
	</div>