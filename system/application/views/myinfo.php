<?php $this->load->view('header'); ?>
<div id='pagehead'><?php echo $pagehead; ?></div>
<div id='loginbox'>
<?php $this->load->helper('form'); 
		echo form_open('my/info/edit');?>
	<label for='cellnumber'>Cell Number:</label><?php echo form_input('cellnumber',$cellnumber); ?>
	<div id='clear'></div>
	<button type="submit" name="submit">Submit</button
		<?php echo form_close(); ?>
</div>
<?php $this->load->view('footer'); ?>