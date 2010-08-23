<?php $this->load->helper('form'); ?>
<?php $this->load->view('header');?>
<div id='pagehead'><?php echo $pagehead; ?></div>
<div id='categories'>
	<div id='title'>Admin Functions</div>
	<span id='item'><a href='<?php echo site_url('admin/users');?>'>Modify Users</a></span>
	<span id='item'><a href='<?php echo site_url('admin/apps');?>'>Modify Apps</a></span>
</div>
<span id='sectiontitle'>Users</span>
<span id='viewall'><a href='<?php echo site_url('admin/users');?>'>View All Users</a></span>
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
<span id='sectiontitle'>Apps</span>
<span id='viewall'><a href='<?php echo site_url('admin/apps');?>'>View All Apps</a></span>
<table id='sectionbox'>
	<tr id='titlerow'>
		<td id='name'>Name</td>
		<td id='version'>Version</td>
		<td id='command'>Default Command</td>
		<td id='description'>Description</td>
	</tr>
	<?php foreach($apps as $app):?>
		<tr id='row'>
			<td id='name'><?php echo $app['name'];?></td>
			<td id='version'><?php echo $app['version'];?></td>
			<td id='command'>
				<?php echo form_open('admin/apps/edit'); ?>
				<input type='hidden' name='name' value='<?php echo $app['name']; ?>'/>
				<?php echo form_input('defaultcommand',$app['defaultcommand']);?>	
				<?php echo form_submit('submit','>');?>
				<?php echo form_close(); ?>
			</td>
			<td id='description'><?php echo $app['description'];?></td>
			<td id='edit'>
				<?php echo form_open('admin/apps/remove');?>
				<input type='hidden' name='name' value='<?php echo $app['name']; ?>'/>
				<?php echo form_submit('submit','[Remove]');?>
				<?php echo form_close();?>
			</td>
		</tr>
	<?php endforeach;?>
</table>
<?php $this->load->view('footer');?>