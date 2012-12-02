<?php if($comments): foreach($comments as $row): ?>
<div class="commentor">
    <div>
    	<strong><?php echo $row->email;?></strong> said on 
			<span style="font-size:14px;">
			   <?php date_default_timezone_set('Etc/UTC');
			      $phpdate = strtotime($row->date_created . " + 1 hour");
			      date_default_timezone_set('America/Los_Angeles');
            echo date('m/d/Y H:i:s', $phpdate); ?>
			</span>
    </div>
    <div><?php echo $row->title; ?></div>
    <div><?php echo $row->body; ?></div>
</div>
<?php endforeach; else: ?>
<h3>No comments yet!</h3>
<?php endif;?>