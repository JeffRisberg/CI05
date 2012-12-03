<div class="post">
  <div style="float: left; margin-right: 5px">
    <img src="<?php echo base_url() ?>/uploads/thumbs/<?php echo $post->image ?>" />
  </div>
  <div class="post meta">
  	<div class="title">
  	  <h2 style="margin-left: 0px; margin-top: 0px;"><?php echo $post->title; ?></h2>
   	</div>
   	<div class="right">
   	  <?php echo anchor("/similar/" . $post->id, "Show Similar Posts"); ?>   	
      <?php date_default_timezone_set('Etc/UTC');
			    $phpdate = strtotime($post->date_created . " + 1 hour");
			    date_default_timezone_set('America/Los_Angeles');
          echo date('m/d/Y H:i:s', $phpdate); ?>     
    </div>
    <br clear="all" />
    
    <?php if (!empty($entity_qualifier_values)) { ?>
			<div class="categories">
			  Posted in
			  <?php $atFirst = true;
			    foreach ($entity_qualifier_values as $entity_qualifier_value) { 
			  	  if (!$atFirst) echo ", ";
			  	  echo $entity_qualifier_value->value; 	  	  
			  	  $atFirst = false;
			  } ?>
			</div>
		<?php } ?>
	</div><!-- Close meta -->
	 
  <p><?php echo $post->body;?></p>          
          
  <div id="comment">
   <?php $this->load->view('post/comment'); ?>
            
	 <?php if (validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
   <?php if ($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
            
   <h3>Leave your comment</h3>
                
   <?php echo form_open('post/saveComment/' . $post_id) ?>     
     <p>Title:<br />
     <input type="text" name="title" size="60" /></p>
     <br clear="all" />
                
     <p>Email:<br />
     <input type="text" name="email" size="60" /></p>
     <br clear="all" />
                
     <p>Comment:<br /></p>
     <textarea rows="6" cols="80%" style="resize:none;" name="body"></textarea>
     <br clear="all" />               
     
     <input type="submit" value="Submit" />
   <?php echo form_close();?>
  </div>
</div>
            