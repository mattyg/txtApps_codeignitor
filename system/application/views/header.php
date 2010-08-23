<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo $title;?> | txtApps</title>
		<?php echo $this->config->item('css'); ?>
		<?php if(isset($morecss)) {echo $morecss; }?>
	</head>
	<body>
	<div id='header'>
		<div id='maintitle'><a href='/'>txtApps</a></div>
		<?php if($this->session->userdata('logged_in')): ?>
			<span id='logout'><a href='<?php echo site_url('user/logout');?>'>Logout</a></span>
			<span id='user'>
				<?php if($this->User_model->get_class($this->session->userdata('user_email')) == 3):?>
						<span id='admin'><a href='<?php echo site_url('admin');?>'>Admin Controls</a></span>
				<?php endif;?>
				<span id='my'><a href='<?php echo site_url('my'); ?>'>My Settings</a></span>
				<span id='email'><?php echo $this->session->userdata('user_email'); ?></span>
			</span>
			
		<?php else: ?>
			<span id='user'>
				<span id='my'><a href='<?php echo site_url('user/login');?>'>Log In</a></span>
				<span id='my'><a href='<?php echo site_url('user/join');?>'>Join</a></span>
			</span>
		<?php endif;?>
	</div>
	<div id='content'>	
	<div id='messages'>
	<?php
	// display all messages
	$messages = $this->messages->get();
	if (is_array($messages)):
	    foreach ($messages as $type => $msgs):
	        foreach ($msgs as $message):
	            echo ('<span class="' .  $type .'">' . $message . '</span>');
	        endforeach;
	    endforeach;
	endif;
	?>
	</div>