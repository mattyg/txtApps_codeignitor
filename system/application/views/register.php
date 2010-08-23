<?php $this->load->view('header'); ?>
<div id='pagehead'><?php echo $pagehead; ?></div>
<div id='registerbox'>
	<?php $this->load->helper('form');
	 	if($userclass === '') {$submit='user/join';}
		 else {$submit='install/deputize';}			
		echo form_open($submit);?>
		<?php echo $userclass;  ?>
		<label for='user_email'>Email:</label><?php echo form_input('user_email'); ?>
		<label for='user_pass'>Password:</label><?php echo form_input('user_pass'); ?>
		<label for='cellnumber'>Cell Number:</label><?php echo form_input('cellnumber');?>
		<div id='clear'></div>
		<button type="submit" name="submit">Join</button>
		<?php echo form_close(); ?>
</div>
<?php $this->load->view('footer'); ?>