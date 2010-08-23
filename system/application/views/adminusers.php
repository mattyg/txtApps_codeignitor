<?php $this->load->helper('form'); ?>
<?php $this->load->view('header');?>
<div id='pagehead'><?php echo $pagehead;?></div>
<div id='categories'>
	<div id='title'>Admin Functions</div>
	<a href='<?php echo site_url('admin/users');?>'>Modify Users</a>
	<a href='<?php echo site_url('admin/apps');?>'>Modify Apps</a>
</div>
<table id='sectionbox'>
	<tr id='titlerow'>
		<td id='name'>Email</td>
		<td id='cellnumber'>Cell Number</td>
		<td id='class'>Class</td>
	</tr>
	<?php foreach($users as $user):?>
		<tr id='row'>
			<td id='name'><?php echo $user['user_email'];?></td>
			<td id='cellnumber'><?php echo $user['cellnumber'];?></td>
			<td id='class'>
				<?php echo form_open('admin/users/edit'); ?>
				<input type='hidden' name='name' value='<?php echo $user['user_email']; ?>'/>
				<?php echo form_input('class',$user['class']);?>	
				<?php echo form_submit('submit','>');?>
				<?php echo form_close(); ?>
			</td>
			<td id='edit'>
				<?php echo form_open('admin/users/remove');?>
				<input type='hidden' name='user_email' value='<?php echo $user['user_email']; ?>'/>
				<?php echo form_submit('submit','[Remove]');?>
				<?php echo form_close();?>
			</td>
		</tr>
	<?php endforeach;?>
</table>
<div id='navlinks'><?php echo $this->pagination->create_links();?></div>
<?php $this->load->view('footer'); ?>
