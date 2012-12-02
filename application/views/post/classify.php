<section class="classify">
	<div style="margin: 10px 0px 5px 5px; font-size:19px; font-weight: bold">
	  Select Categories for Post: <?php echo $post->title; ?>
	</div>
	
	<?php echo form_open("post/postClassify", 'class="crud"'); ?>
		<input type="hidden" name="post_id" value="<?php echo $post->id; ?>" />	
		<table cellspacing="5">
			<tr>
			<?php foreach ($qualifiers as $key => $qualifier): ?>
			<td valign="top">
			   <div class="qualifier"><?php echo $qualifier->name ?></div>
			   
			   <?php foreach ($qualifier_values as $qualifier_value): ?>
			     <?php if ($qualifier->id == $qualifier_value->qualifier_id) { ?>
			       <?php 
			       $isAssociated = false;  
			       if (!empty($entity_qualifier_values)) {
			       
			       	foreach ($entity_qualifier_values as $entity_qualifier_value) {
			       		if ($entity_qualifier_value->qualifier_value_id == $qualifier_value->id) {
			       			$isAssociated = true;
			       		}
			       	}
			       }           
					   ?>
						
			       <input type="checkbox" value="<?php echo $qualifier_value->id ?>" 
			         id="<?php echo $qualifier_value->id ?>" name="qualifiervalue[]"
			         <?php if ($isAssociated) { echo 'checked="true"'; } ?> />
			       &nbsp;
			       <?php echo $qualifier_value->value ?>			     
			       <br/>			   
			     <?php } ?>
			   <?php endforeach ?>
			</td>
			  <?php if ($key == 2 || $key == 5) { ?>
			  </tr>
			  <tr>
			  <?php } ?>
			<?php endforeach ?>
		</table>
		
		<input type="submit" value="Submit" />

	<?php echo form_close(); ?>
</section>
