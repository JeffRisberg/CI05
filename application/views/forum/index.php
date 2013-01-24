<div class="post">
	<div class="post meta">
		<div class="title">
			<h2>Forum Topics</h2>
		</div>
	</div>
	<br clear="all" />
	
	
	<?php foreach ($qualifiers as $qualifier): ?>
		<p> </p>
		<table>
			<tr> 
				<td valign="top">
					<strong> <?php echo $qualifier->name ?> </strong>
				</td>
			</tr>
			<?php foreach ($qualifier_values as $qv): 
				if ($qv->qualifier_id == $qualifier->id): ?>
					<tr>
						<td valign="top">
							<div class="qv"><?php echo $qv->value ?></div>
						</td>
					</tr>
			<?php endif; endforeach ?>
		</table>
	<?php endforeach ?>
	<p>Edit this page in views/forum/index.php</p>
</div><!-- Close post -->