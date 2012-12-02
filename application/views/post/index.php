<?php if ($this->session->flashdata('message')) {
	echo '<p class="success">'.$this->session->flashdata('message').'</p>';
} ?>

<?php if ($posts): foreach($posts as $post):?>
<div class="post">
  <div style="float: left; margin-right: 5px">
    <img src="<?php echo base_url() ?>/uploads/thumbs/<?php echo $post->image ?>" />
  </div>
	<div class="post meta">
		<div class="title">
			<h2 style="margin-left: 0px">
			  <?php echo anchor('post/view/' . $post->id, $post->title) ?>		
			  <?php echo anchor('post/edit/' . $post->id, "[Edit]") ?>		
			</h2>
		</div>
		<div class="date">
			<?php date_default_timezone_set('Etc/UTC');
			      $phpdate = strtotime($post->date_created . " + 1 hour");
			      date_default_timezone_set('America/Los_Angeles');
            echo date('m/d/Y H:i:s', $phpdate); ?>
		</div>
		<br clear="all" />
    
    <?php if (!empty($post->entity_qualifier_values)) { ?>
			<div class="categories">
			  Posted in
			  <?php $atFirst = true;
			    foreach ($post->entity_qualifier_values as $entity_qualifier_value) { 
			  	  if (!$atFirst) echo ", ";
			  	  echo $entity_qualifier_value->value; 	  	  
			  	  $atFirst = false;
			  } ?>
			</div>
		<?php } ?>
	</div><!-- Close meta -->
	<p>
		<?php echo $post->body ?>
	</p>
	<hr />
</div><!-- Close post -->
<?php endforeach; else: ?>
  <h2>No posts yet</h2>
<?php endif; ?>