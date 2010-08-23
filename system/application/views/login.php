<?php $this->load->view('header'); ?>
<div id='pagehead'><?php echo $pagehead; ?></div>
<div id='loginbox'>
<?php $this->load->helper('form'); 
		echo form_open('user/login');?>
	<label for='user_email'>Email:</label><?php echo form_input('user_email'); ?>
	<label for='user_pass'>Password:</label><?php echo form_input('user_pass');?>
	<div id='clear'></div>
	<button type="submit" name="submit">Login</button
		<?php echo form_close(); ?>
</div>
<?php $this->load->view('footer'); ?>