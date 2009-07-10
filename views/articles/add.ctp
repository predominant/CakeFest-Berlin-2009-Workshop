<div class="articles form">
<?php echo $form->create('Article');?>
	<fieldset>
 		<legend><?php __('Add Article');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('text');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Articles', true), array('action'=>'index'));?></li>
	</ul>
</div>
