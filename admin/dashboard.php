<div class="wrap">
	<?php 
		$action = new Actions();
		$datas = $action->getAllData('wp_cf_shortcodes'); 
		
		if ($_GET['action'] == "delete") {
			 $result = $action->deleteRec('wp_cf_shortcodes','cf_id',$_GET['id']);
			 echo '<h2>Deleting...</h2>';
			 if ( $result > 0 ) {
				echo '<script type="text/javascript">window.location.href = "'.get_bloginfo('url') . '/wp-admin/admin.php?page=' . $_GET['page'] .'&success_msg=1"; </script>';
				 }
		} elseif ($_GET['action'] == "edit") {
			require_once('edit-shortcode.php');
		} else {
	?>
	<h2>Custom Product Filter</h2>
	<p>&nbsp; </p>
	
	<table class="widefat">
			<thead>
				<tr>
					<td>No.</td>
					<td>Name</td>
					<td>Shortcode</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
			
				<?php 
					$ctr = 1; 
					foreach ( $datas as $data ) :
				?>
					<tr>
						<td><?php echo $ctr; ?></td>
						<td><?php echo $data->cf_name; ?></td>
						<td><?php echo $data->cf_shortcode; ?></td>
						<td>
							<a href="?page=<?php echo $_GET['page'] ?>&action=edit&id=<?php echo $data->cf_id; ?>">Edit</a> | 
							<a href="?page=<?php echo $_GET['page'] ?>&action=delete&id=<?php echo $data->cf_id; ?>" onclick="return confirm('Are you sure to delete this item?'); ">Delete</a>
						</td>
					</tr>
				<?php $ctr++; endforeach; ?>
				
			</tbody>
			<tfoot>
				<tr>
					<td>No.</td>
					<td>Name</td>
					<td>Shortcode</td>
					<td>Actions</td>
				</tr>
			</tfoot>
	</table>
	<?php } ?>
	
</div>