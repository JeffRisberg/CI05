<div class="post">
	<div class="post meta">
		<div class="title">
			<h2>About Me</h2>
		</div>
	</div>
	<br clear="all" />
	
	
	<table>
		<tr> 
			<td valign="top"> 
				<strong> Monthes </strong> 
			</td> 
		</tr>
		<tr>
			<?php foreach ($monthes as $month): ?>
			<td valign="top">
			   <div class="month"><?php echo $month ?></div>
			</td>
		</tr>
		<?php endforeach ?>
	</table>
	
	<p>This is a sample of static page. Edit this page in
		views/about/index.php</p>
</div><!-- Close post -->