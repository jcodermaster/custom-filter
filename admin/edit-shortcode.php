<div class="wrap">
	<?php 
		$action = new Actions();
		$allProd = $action->getCategories(0); 
	?>
	<?php 
		if ( isset($_POST['submit']) ) {
			$name = $_POST['filter_name'];
			$cat = $_POST['filter_cat'];
			$prod_per_page = $_POST['prod_per_page'];
			$proc = true;
			$err = NULL;
			
			if ( empty($name) ) {
				$err .= 'Filter name is required';
				$proc = false;
			}
			
			if ( empty($cat) ) {
				$err .= 'Filter category is required';
				$proc = false;
			}
			
			$shortcode = '[custom-filter cat="'.$cat.'" filter_name="'.$name.'"]';
			if ( $proc ){
				
				$data = array('cf_name' => $name,
						  'cf_shortcode' => $shortcode,
						  'cf_cat_id' => $cat);
						  
				$updateFilter = $action->updateData('wp_cf_shortcodes',$_GET[id], 'cf_id', $data);
				
				if ($updateFilter > 0) {
					echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
							<p><strong>Filter successfully updated.</strong> <a href="admin.php?page=custom_filter">View Filter Shortcode</a></p>
							<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
						</div>';
				} else {
					echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
							<p><strong>Error in adding.</strong></p>
							<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
						</div>';
				}
			}
			
		}
		
		$shortcode = $action->getSingleRow('wp_cf_shortcodes','cf_id',$_GET['id']);
	?>
	<h2>Edit Filter Shortcodes</h2>
	
	<form action="<?php $PHP_SELF; ?>" method="post">
			<table class="form-table">
				<tr>
					<th><label for="filter_name">Name</label></th>
					<td>
						<input type="text" name="filter_name" id="filter_name" value="<?php echo $shortcode[0]->cf_name; ?>"/>
					</td>
				</tr>
				<tr>
					<th><label for="product">Product</label></th>
					<td>
						<select name="filter_cat" id="product">
							<option value="">--Select Product--</option>
							<?php foreach ( $allProd as $prod ) : ?>
								<option value="<?php echo $prod->term_id;?>" <?php echo $action->checkSelect($shortcode[0]->cf_cat_id,$prod->term_id)?>><?php echo $prod->name; ?></option>
							<?php endforeach; ?>
							
						</select>
					</td>
				</tr>
			</table>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Submit"></p>
	</form>
	
</div>