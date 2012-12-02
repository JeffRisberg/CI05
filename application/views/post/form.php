<h2><?php echo lang('post:' . $method); ?></h2>

<?php if (validation_errors()) {
	echo validation_errors('<p class="error">','</p>');
} ?>
      
<?php if ($this->session->flashdata('message')) {
	echo '<p class="success">'.$this->session->flashdata('message').'</p>';
} ?>

<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
<p>
	<strong>Title</strong>:<br /> 
	<?php echo form_input('title', $post->title, 'size="80" style="width:600px"'); ?>
</p>

<p>
	<strong>Body</strong>: (HTML mode)<br/>
  <?php echo form_textarea('body', $post->body, 'rows="5" cols="60" style="width: 700px; height: 100px;"'); ?>
</p>

<p>
  <strong>Image</strong>:<br/>
  <input type="file" name="image" size="45" />	
</p>

<p>
	<input type="submit" value="Submit" />
</p>
<?php echo form_close(); ?>