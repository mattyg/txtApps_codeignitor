<?php $this->load->helper('form'); ?>
<?php $this->load->view('header');?>
<div id='pagehead'><?php echo $pagehead;?></div>
<div id='categories'>
	<div id='title'>My Options</div>
	<a href='<?php echo site_url('my/info');?>'>Modify Info</a>
	<a href='<?php echo site_url('my/apps');?>'>Modify Apps</a>
</div>
<span id='sectiontitle'>My Info</span>
<div id='loginbox'>
	<?php $this->load->helper('form'); 
	echo form_open('my/info/edit');?>
	<label for='cellnumber'>Cell Number:</label><?php echo form_input('cellnumber',$cellnumber); ?>
	<div id='clear'></div>
	<button type="submit" name="submit">Submit</button
	<?php echo form_close(); ?>
</div>
<span id='sectiontitle'>My Apps</span><span id='viewall'><a href='<?php echo site_url('my/apps');?>'>View All Apps</a></span>
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
				<?php echo form_open('my/apps/edit'); ?>
				<input type='hidden' name='id' value='<?php echo $app['id']; ?>'/>
				<?php echo form_input('command',$app['defaultcommand']);?>	
				<?php echo form_submit('submit','>');?>
				<?php echo form_close(); ?>
			</td>
			<td id='description'><?php echo $app['description'];?></td>
			<td id='edit'>
				<?php echo form_open('my/apps/remove');?>
				<input type='hidden' name='name' value='<?php echo $app['name']; ?>'/>
				<?php echo form_submit('submit','[Remove]');?>
				<?php echo form_close();?>
			</td>
		</tr>
	<?php endforeach;?>
</table>
<?php $this->load->view('footer'); ?>
